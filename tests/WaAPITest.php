<?php

it('can get instance by ID', function () {
    $waAPI = new \WaAPI\WaAPI\WaAPI();

    $response = $waAPI->getInstanceById($waAPI->getInstanceId());

    $this->assertSame($waAPI->getInstanceId(),(int) $response->id);
});

it('fails QR request on ready state', function () {
    $waAPI = new \WaAPI\WaAPI\WaAPI();

    $response = $waAPI->getInstanceQrCode();

})->throws('instance not in QR mode');

it('can get instances', function () {
    $waAPI = new \WaAPI\WaAPI\WaAPI();

    $instances = $waAPI->getInstances();

    $this->assertIsArray($instances);
});

it('can get instance status', function () {
    $waAPI = new \WaAPI\WaAPI\WaAPI();

    $meInfo = $waAPI->getInstanceStatus();

    $this->assertSame('ready', $meInfo->instanceStatus);
});


it('can get instance info', function () {
    $waAPI = new \WaAPI\WaAPI\WaAPI();

    $meInfo = $waAPI->getInstanceInfo();

    $this->assertSame($waAPI->getInstanceId(), (int)$meInfo->instanceId);
});

it('can get message by id', function () {
    $waAPI = new \WaAPI\WaAPI\WaAPI();

    $response = $waAPI->getMessageById('false_123456789@c.us_ABCDEFGHIJKLMNOP');

    $this->assertArrayHasKey('message', $response->data);
})->skip();

it('can fetch messages', function () {
    $waAPI = new \WaAPI\WaAPI\WaAPI();

    $response = $waAPI->fetchMessages('123456789@c.us', 1, false, false);

    $this->assertSame('test', print_r($response->data, true));
})->skip('needs to be fixed');


it('can get chats', function () {
    $waAPI = new \WaAPI\WaAPI\WaAPI();

    $response = $waAPI->getChats();

    $this->assertArrayHasKey('id', $response->data[0]);
});

it('can send vCard', function () {
    $waAPI = new \WaAPI\WaAPI\WaAPI();

    $response = $waAPI->sendVcard('123456789@c.us', new \WaAPI\WaAPI\Resources\Vcard(
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
})->skip();;

it('can mark chat as seen', function () {
    $waAPI = new \WaAPI\WaAPI\WaAPI();

    $response = $waAPI->sendSeen('123456789@c.us');

    $this->assertTrue($response->data['seenSend']);
})->skip();;

it('can send media from Url', function () {
    $waAPI = new \WaAPI\WaAPI\WaAPI();

    $response = $waAPI->sendMediaFromUrl(
        '123456789@c.us',
        'https://waapi.app/imgs/christian-wiediger-5BG-9id-A6I-unsplash.jpg',
        'Test Caption',
        'test.jpg'
    );

    $this->assertArrayHasKey('_data', $response->data);
})->skip();

it('can send message', function () {
    $waAPI = new \WaAPI\WaAPI\WaAPI();

    $response = $waAPI->sendMessage('123456789@c.us', 'This is a test message');

    $this->assertArrayHasKey('_data', $response->data);
})->skip();
