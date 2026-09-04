<?php

declare(strict_types=1);

namespace WaAPI\WaAPI\Tests;

use WaAPI\WaAPI\WaAPI;

/**
 * The live half of the old WaAPITest: the same calls, against the real API.
 *
 * Kept because the mocked tests and these answer different questions. The
 * mocked ones prove the SDK sends what it claims to send; these prove the
 * service still answers in the shape the SDK unwraps -- a field renamed on the
 * server is invisible to a fake and breaks every caller.
 *
 * Opt-in through WAAPI_LIVE_TESTS, deliberately NOT through the presence of a
 * token: phpunit.xml.dist already sets WAAPI_API_TOKEN=token and
 * WAAPI_INSTANCE_ID=123 as placeholders, so a guard on "is a token
 * configured" is satisfied on every machine and skips nowhere. That placeholder
 * is why the old suite reported five errors rather than five skips -- the calls
 * went out and came back "Unauthenticated." To run these:
 *
 *     WAAPI_LIVE_TESTS=1 WAAPI_API_TOKEN=<real> WAAPI_INSTANCE_ID=<real> \
 *         vendor/bin/phpunit tests/LiveApiTest.php
 *
 * Read-only by design. The four write actions the old file carried --
 * sendMessage, sendMediaFromUrl, sendSeen, sendVcard -- are not here and must
 * not be added: they were only harmless while permanently skipped, and against
 * a connected instance each one sends a real message to a real number. Their
 * payloads are asserted in WaAPITest against the fake.
 */
class LiveApiTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (! filter_var(env('WAAPI_LIVE_TESTS', false), FILTER_VALIDATE_BOOLEAN)) {
            $this->markTestSkipped('Set WAAPI_LIVE_TESTS=1 with real credentials to run the live API tests.');
        }
    }

    public function test_can_get_instance_by_id(): void
    {
        $waAPI = new WaAPI;

        $response = $waAPI->getInstanceById($waAPI->getInstanceId());

        $this->assertSame($waAPI->getInstanceId(), (int) $response->id);
    }

    public function test_can_get_instances(): void
    {
        $waAPI = new WaAPI;

        $this->assertIsArray($waAPI->getInstances());
    }

    public function test_can_get_instance_status(): void
    {
        $waAPI = new WaAPI;

        $status = $waAPI->getInstanceStatus();

        $this->assertNotNull($status->instanceStatus);
        $this->assertSame($waAPI->getInstanceId(), (int) $status->instanceId);
    }

    public function test_can_get_instance_info(): void
    {
        $waAPI = new WaAPI;

        $meInfo = $waAPI->getInstanceInfo();

        $this->assertSame($waAPI->getInstanceId(), (int) $meInfo->instanceId);
    }

    public function test_can_get_chats(): void
    {
        $waAPI = new WaAPI;

        $response = $waAPI->getChats();

        $this->assertIsArray($response->data);
    }
}
