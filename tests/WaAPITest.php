<?php

namespace WaAPI\WaAPI\Tests;

use WaAPI\WaAPI\Resources\Vcard;
use WaAPI\WaAPI\WaAPI;

class WaAPITest extends TestCase
{
    public function test_can_get_instance_by_id(): void
    {
        $waAPI = new WaAPI;

        $response = $waAPI->getInstanceById($waAPI->getInstanceId());

        $this->assertSame($waAPI->getInstanceId(), (int) $response->id);
    }

    public function test_fails_qr_request_on_ready_state(): void
    {
        $waAPI = new WaAPI;

        $this->expectExceptionMessage('instance not in QR mode');

        $waAPI->getInstanceQrCode();
    }

    public function test_can_get_instances(): void
    {
        $waAPI = new WaAPI;

        $instances = $waAPI->getInstances();

        $this->assertIsArray($instances);
    }

    public function test_can_get_instance_status(): void
    {
        $waAPI = new WaAPI;

        $meInfo = $waAPI->getInstanceStatus();

        $this->assertSame('ready', $meInfo->instanceStatus);
    }

    public function test_can_get_instance_info(): void
    {
        $waAPI = new WaAPI;

        $meInfo = $waAPI->getInstanceInfo();

        $this->assertSame($waAPI->getInstanceId(), (int) $meInfo->instanceId);
    }

    /** @skip */
    public function test_can_get_message_by_id(): void
    {
        $this->markTestSkipped();

        $waAPI = new WaAPI;

        $response = $waAPI->getMessageById('false_123456789@c.us_ABCDEFGHIJKLMNOP');

        $this->assertArrayHasKey('message', $response->data);
    }

    /** @skip */
    public function test_can_fetch_messages(): void
    {
        $this->markTestSkipped('needs to be fixed');

        $waAPI = new WaAPI;

        $response = $waAPI->fetchMessages('123456789@c.us', 1, false, false);

        $this->assertSame('test', print_r($response->data, true));
    }

    public function test_can_get_chats(): void
    {
        $waAPI = new WaAPI;

        $response = $waAPI->getChats();

        $this->assertArrayHasKey('id', $response->data[0]);
    }

    /** @skip */
    public function test_can_send_vcard(): void
    {
        $this->markTestSkipped();

        $waAPI = new WaAPI;

        $response = $waAPI->sendVcard('123456789@c.us', new Vcard(
            '123456789',
            '+123456789',
            'lastname',
            'firstname',
            'display name',
            'title',
            'second name',
            'addiotnal name',
            'organization',
            'email@email.com',
            'street',
            'city',
            'zip',
            'state',
            'country',
            'www.website.com'
        ));

        $this->assertArrayHasKey('sendVcard', $response->data);
    }

    /** @skip */
    public function test_can_mark_chat_as_seen(): void
    {
        $this->markTestSkipped();

        $waAPI = new WaAPI;

        $response = $waAPI->sendSeen('123456789@c.us');

        $this->assertTrue($response->data['seenSend']);
    }

    /** @skip */
    public function test_can_send_media_from_url(): void
    {
        $this->markTestSkipped();

        $waAPI = new WaAPI;

        $response = $waAPI->sendMediaFromUrl(
            '123456789@c.us',
            'https://waapi.app/imgs/christian-wiediger-5BG-9id-A6I-unsplash.jpg',
            'Test Caption',
            'test.jpg'
        );

        $this->assertArrayHasKey('_data', $response->data);
    }

    /** @skip */
    public function test_can_send_message(): void
    {
        $this->markTestSkipped();

        $waAPI = new WaAPI;

        $response = $waAPI->sendMessage('123456789@c.us', 'This is a test message');

        $this->assertArrayHasKey('_data', $response->data);
    }
}
