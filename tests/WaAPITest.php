<?php

declare(strict_types=1);

namespace WaAPI\WaAPI\Tests;

use WaAPI\WaAPI\Resources\Vcard;
use WaAPI\WaAPISdk\Resources\Instance;

/**
 * The hand-written half of this package: the five instance endpoints and the
 * seven actions that predate the generated methods in GeneratedActionsTest.
 *
 * These twelve used to call the live API through `new WaAPI`, which needed a
 * valid token in the environment and an instance in exactly the right state --
 * so six of them were switched off with markTestSkipped() and the other six
 * failed on any machine without credentials. A skipped test asserts nothing
 * while continuing to vouch for the method it names, and two of the six had
 * assertions that could never have passed even connected:
 * test_can_fetch_messages compared the response against the literal 'test'.
 *
 * Rewritten against the faked transport, all twelve now run everywhere and
 * assert the thing these methods can actually get wrong -- the endpoint or
 * action they name, and the payload they forward.
 */
class WaAPITest extends TestCase
{
    use FakesTheApi;

    // ---------------------------------------------------------------- instances

    public function test_get_instance_by_id_reads_the_instance_endpoint(): void
    {
        $waapi = $this->fakeResponse([
            'status' => 'success',
            'instance' => ['id' => 7, 'name' => 'instance-name'],
        ]);

        $instance = $waapi->getInstanceById(7);

        $this->assertRequested('GET', '/api/v1/instances/7');
        $this->assertSame(7, (int) $instance->id);
        $this->assertSame('instance-name', $instance->name);
    }

    /**
     * The id reaching the URL is the whole point: getInstanceById is the only
     * one of the five that does not fall back to the configured instance, so a
     * method that ignored its argument would still return a plausible object.
     */
    public function test_get_instance_by_id_uses_the_argument_not_the_configured_instance(): void
    {
        $waapi = $this->fakeResponse([
            'status' => 'success',
            'instance' => ['id' => 99],
        ]);

        $waapi->getInstanceById(99);

        $this->assertRequested('GET', '/api/v1/instances/99');
    }

    public function test_get_instances_returns_a_collection_of_instances(): void
    {
        $waapi = $this->fakeResponse([
            'status' => 'success',
            'instances' => [
                ['id' => 1, 'name' => 'first'],
                ['id' => 2, 'name' => 'second'],
            ],
        ]);

        $instances = $waapi->getInstances();

        $this->assertRequested('GET', '/api/v1/instances');
        $this->assertCount(2, $instances);
        $this->assertContainsOnlyInstancesOf(Instance::class, $instances);
        $this->assertSame('second', $instances[1]->name);
    }

    public function test_get_instance_status_reads_the_client_status_endpoint(): void
    {
        $waapi = $this->fakeResponse([
            'status' => 'success',
            'clientStatus' => ['instanceId' => 1, 'instanceStatus' => 'ready'],
        ]);

        $status = $waapi->getInstanceStatus();

        $this->assertRequested('GET', '/api/v1/instances/1/client/status');
        $this->assertSame('ready', $status->instanceStatus);
    }

    /**
     * `me` and `qrCode` nest their payload one level deeper than the other three
     * resources -- InstanceClientMe::__construct reads $attributes['data'] --
     * so this asserts the unwrapping, not just the endpoint.
     */
    public function test_get_instance_info_unwraps_the_nested_me_payload(): void
    {
        $waapi = $this->fakeResponse([
            'status' => 'success',
            'me' => ['data' => ['instanceId' => 1, 'displayName' => 'display-name']],
        ]);

        $me = $waapi->getInstanceInfo();

        $this->assertRequested('GET', '/api/v1/instances/1/client/me');
        $this->assertSame(1, (int) $me->instanceId);
        $this->assertSame('display-name', $me->displayName);
    }

    public function test_get_instance_qr_code_returns_the_code_from_the_qr_endpoint(): void
    {
        $waapi = $this->fakeResponse([
            'status' => 'success',
            'qrCode' => ['data' => [
                'instanceId' => 1,
                'qrCode' => 'data:image/png;base64,QUJD',
            ]],
        ]);

        $qr = $waapi->getInstanceQrCode();

        $this->assertRequested('GET', '/api/v1/instances/1/client/qr');
        $this->assertSame('data:image/png;base64,QUJD', $qr->qrCode);
    }

    /**
     * The predecessor of this test expected getInstanceQrCode() to throw
     * 'instance not in QR mode' on a connected instance. It does not, and this
     * pins what it does instead: the node answers HTTP 200 with
     * `{status: error}` nested under `qrCode`, the proxy sees a successful
     * response and stamps `status: success` on the envelope, so nothing in the
     * SDK's error handling ever fires.
     *
     * What the caller gets instead: no exception, `qrCode` null, two PHP
     * warnings from reading $attributes['data'] on a body that has no `data`
     * key -- and the reason readable only as ->message, a property no signature
     * or docblock mentions. Discoverable, but only by someone who already
     * suspects it.
     *
     * That is a defect in waapi-php-sdk, not in this package -- reported rather
     * than fixed here, since raising instead would change published behaviour.
     * When the SDK starts raising, this test fails and should be replaced by
     * the exception assertion.
     */
    public function test_qr_code_error_from_the_node_arrives_without_an_exception(): void
    {
        $waapi = $this->fakeResponse([
            'status' => 'success',
            'qrCode' => [
                'status' => 'error',
                'message' => 'instance not in QR mode',
                'instanceId' => '1',
            ],
        ]);

        $qr = @$waapi->getInstanceQrCode();

        $this->assertNull($qr->qrCode ?? null, 'A QR code was returned for an instance that is not in QR mode.');
        $this->assertSame('instance not in QR mode', $qr->message ?? null);
    }

    // ------------------------------------------------------------------ actions

    public function test_send_message_forwards_chat_message_and_mentions(): void
    {
        $waapi = $this->fakeAction();

        $waapi->sendMessage('chatId-value@c.us', 'message-value', ['mention-one', 'mention-two']);

        $this->assertActionCalled('send-message', [
            'chatId' => 'chatId-value@c.us',
            'message' => 'message-value',
            'mentions' => ['mention-one', 'mention-two'],
        ]);
    }

    public function test_send_media_from_url_forwards_url_caption_and_name(): void
    {
        $waapi = $this->fakeAction();

        $waapi->sendMediaFromUrl(
            'chatId-value@c.us',
            'https://example.com/mediaUrl-value.jpg',
            'mediaCaption-value',
            'mediaName-value.jpg'
        );

        $this->assertActionCalled('send-media', [
            'chatId' => 'chatId-value@c.us',
            'mediaUrl' => 'https://example.com/mediaUrl-value.jpg',
            'mediaCaption' => 'mediaCaption-value',
            'mediaName' => 'mediaName-value.jpg',
        ]);
    }

    public function test_send_seen_forwards_the_chat_id(): void
    {
        $waapi = $this->fakeAction();

        $waapi->sendSeen('chatId-value@c.us');

        $this->assertActionCalled('send-seen', ['chatId' => 'chatId-value@c.us']);
    }

    public function test_get_chats_calls_the_action_with_an_empty_payload(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getChats();

        $this->assertActionCalled('get-chats', []);
        $this->assertSame([], $this->sentPayload(), 'get-chats takes no parameters and must not invent any.');
    }

    public function test_fetch_messages_forwards_every_filter(): void
    {
        $waapi = $this->fakeAction();

        $waapi->fetchMessages('chatId-value@c.us', 17, false, true);

        $this->assertActionCalled('fetch-messages', [
            'chatId' => 'chatId-value@c.us',
            'limit' => 17,
            'fromMe' => false,
            'includeMedia' => true,
        ]);
    }

    /**
     * limit defaults to 25 rather than being omitted, so a caller that never
     * names it still asks for a bounded page.
     */
    public function test_fetch_messages_sends_its_default_limit(): void
    {
        $waapi = $this->fakeAction();

        $waapi->fetchMessages('chatId-value@c.us');

        $this->assertActionCalled('fetch-messages', [
            'chatId' => 'chatId-value@c.us',
            'limit' => 25,
        ]);
    }

    public function test_get_message_by_id_forwards_the_message_id(): void
    {
        $waapi = $this->fakeAction();

        $waapi->getMessageById('false_123456789@c.us_ABCDEFGHIJKLMNOP', true);

        $this->assertActionCalled('get-message-by-id', [
            'messageId' => 'false_123456789@c.us_ABCDEFGHIJKLMNOP',
            'includeMedia' => true,
        ]);
    }

    /**
     * The one method in this package that transforms its argument rather than
     * forwarding it: everything else names an action and passes named
     * parameters through compact(). Asserting field by field, because a Vcard
     * with sixteen positional constructor arguments is exactly the shape where
     * two adjacent values swap without any test noticing.
     */
    public function test_send_vcard_serialises_every_field_of_the_vcard(): void
    {
        $waapi = $this->fakeAction();

        $waapi->sendVcard('chatId-value@c.us', new Vcard(
            'waid-value',
            'iternationalnumber-value',
            'lastname-value',
            'firstname-value',
            'displayname-value',
            'title-value',
            'secondname-value',
            'additionalname-value',
            'organization-value',
            'email-value',
            'street-value',
            'city-value',
            'zip-value',
            'state-value',
            'country-value',
            'website-value'
        ));

        $this->assertActionCalled('send-vcard', ['chatId' => 'chatId-value@c.us']);

        $payload = $this->sentPayload();

        $this->assertArrayHasKey('vCard', $payload, 'The vcard never reached the request body.');

        foreach ([
            'waid', 'iternationalnumber', 'lastname', 'firstname', 'displayname',
            'title', 'secondname', 'additionalname', 'organization', 'email',
            'street', 'city', 'zip', 'state', 'country', 'website',
        ] as $field) {
            $this->assertSame(
                $field.'-value',
                $payload['vCard'][$field] ?? null,
                "The vcard field {$field} arrived empty or holding another field's value."
            );
        }
    }
}
