<?php

declare(strict_types=1);

namespace WaAPI\WaAPI\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use WaAPI\WaAPI\WaAPI;
use WaAPI\WaAPISdk\WaAPISdk;

/**
 * A faked transport for the SDK, so a test asserts what the SDK sends instead
 * of what the live service happens to answer.
 *
 * The existing tests in this package construct `new WaAPI` and call the real
 * waapi.app: they need a valid token and an instance in the right state, which
 * is why the suite reports errors on any machine that has neither. Nothing
 * about a method that names an action and forwards its parameters requires a
 * network.
 *
 * Guzzle's MockHandler rather than Laravel's Http::fake(): this package talks
 * to the API through waapi-php-sdk, which builds a Guzzle client directly, so
 * Laravel's HTTP facade never sees the request. Faking the wrong layer would
 * produce a green test over a live call.
 */
trait FakesTheApi
{
    /** @var list<array<string, mixed>> */
    protected array $recorded = [];

    /**
     * Answers every request with the envelope the SDK actually accepts and
     * records what went out.
     *
     * `status` sits at the TOP level, not inside `data`. MakesHttpRequests
     * checks `$body['status'] === 'success'` there and throws the raw body as
     * an exception otherwise -- a first version of this helper nested it under
     * `data` and every one of the 101 tests failed with the response as the
     * error message.
     *
     * @param  array<string, mixed>  $data
     */
    protected function fakeAction(array $data = [], int $status = 200): WaAPI
    {
        $this->recorded = [];

        $mock = new MockHandler(array_fill(0, 50, new Response(
            $status,
            ['Content-Type' => 'application/json'],
            json_encode([
                'status' => 'success',
                'data' => $data + ['id' => 1],
            ], JSON_THROW_ON_ERROR),
        )));

        $stack = HandlerStack::create($mock);
        $stack->push(Middleware::history($this->recorded));

        return new WaAPI(1, new WaAPISdk('test-token', new Client(['handler' => $stack])));
    }

    /**
     * Answers with an arbitrary top-level body, for the endpoints that are not
     * client actions.
     *
     * The instance endpoints put their payload at the TOP level under their own
     * key -- `instance`, `instances`, `clientStatus`, `qrCode`, `me` -- not
     * under `data`, and two of the five resources then read `data` from inside
     * that. fakeAction() cannot express any of it, which is why the five
     * instance tests could never have been written against it.
     *
     * @param  array<string, mixed>  $body
     */
    protected function fakeResponse(array $body, int $status = 200): WaAPI
    {
        $this->recorded = [];

        $mock = new MockHandler(array_fill(0, 50, new Response(
            $status,
            ['Content-Type' => 'application/json'],
            json_encode($body, JSON_THROW_ON_ERROR),
        )));

        $stack = HandlerStack::create($mock);
        $stack->push(Middleware::history($this->recorded));

        return new WaAPI(1, new WaAPISdk('test-token', new Client(['handler' => $stack])));
    }

    /**
     * Asserts the verb and path of the request that went out.
     */
    protected function assertRequested(string $method, string $path): void
    {
        $this->assertNotEmpty($this->recorded, 'The SDK sent no request at all.');

        $request = $this->recorded[0]['request'];

        $this->assertSame($method, $request->getMethod(), 'The method used a different HTTP verb.');

        // Compared whole rather than by suffix, and with the leading slash
        // trimmed off both sides: the SDK builds relative URIs ('api/v1/...')
        // and only picks up a leading slash once a base_uri resolves them, so a
        // suffix match would be the only thing that survives both -- and a
        // suffix match cannot see a wrong prefix.
        $this->assertSame(
            ltrim($path, '/'),
            ltrim($request->getUri()->getPath(), '/'),
            'The method called a different endpoint.'
        );
    }

    /**
     * The decoded body of the request that went out, for the cases where a
     * key-by-key assertion is needed rather than assertActionCalled()'s
     * flattened comparison -- sendVcard being the one method in this package
     * that transforms its argument instead of forwarding it.
     *
     * @return array<string, mixed>
     */
    protected function sentPayload(): array
    {
        $this->assertNotEmpty($this->recorded, 'The SDK sent no request at all.');

        $raw = (string) $this->recorded[0]['request']->getBody();
        $body = json_decode($raw, true);

        if (! is_array($body)) {
            parse_str($raw, $body);
        }

        return $body;
    }

    /**
     * Asserts the action that was called and the exact body that carried it.
     *
     * Both halves matter and for different reasons: the action name is the only
     * thing distinguishing 122 otherwise identical methods, and the payload is
     * where a parameter dropped from compact() disappears silently -- the call
     * still succeeds, the field just never arrives.
     *
     * @param  array<string, mixed>  $expected
     */
    protected function assertActionCalled(string $action, array $expected): void
    {
        $this->assertNotEmpty($this->recorded, 'The SDK sent no request at all.');

        $request = $this->recorded[0]['request'];

        $this->assertStringEndsWith(
            "/client/action/{$action}",
            $request->getUri()->getPath(),
            'The method called a different action than it is named for.'
        );

        $raw = (string) $request->getBody();
        $body = json_decode($raw, true);

        // The SDK sends form_params unless the payload carries a `json` key
        // (MakesHttpRequests::request), so the body is usually URL-encoded and
        // not JSON. Decoding only JSON made every assertion below report the
        // parameter as missing while it was sitting in the request all along.
        if (! is_array($body)) {
            parse_str($raw, $body);
        }

        foreach ($expected as $key => $value) {
            $this->assertArrayHasKey($key, $body, "Parameter {$key} never reached the request body.");

            // Compared as strings: form encoding has no types, so 42 arrives as
            // "42" and true as "1". Asserting identity here would test PHP's
            // encoder rather than whether the parameter survived the call.
            $this->assertSame(
                $this->flatten($value),
                $this->flatten($body[$key]),
                "Parameter {$key} arrived with a different value."
            );
        }
    }

    /**
     * @param  mixed  $value
     */
    private function flatten($value): string
    {
        if (is_array($value)) {
            return implode('|', array_map(fn ($v): string => $this->flatten($v), $value));
        }

        if (is_bool($value)) {
            return $value ? '1' : '0';
        }

        return (string) $value;
    }
}
