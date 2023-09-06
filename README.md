# WaAPI Laravel Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/waapi/waapi-laravel-sdk.svg?style=flat-square)](https://packagist.org/packages/waapi/waapi-laravel-sdk)
[![Total Downloads](https://img.shields.io/packagist/dt/waapi/waapi-laravel-sdk.svg?style=flat-square)](https://packagist.org/packages/waapi/waapi-laravel-sdk)

Laravel Package to use with [waapi.app](https://waapi.app).


## Installation

You can install the package via composer:

```bash
composer require waapi/waapi-laravel-sdk
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="waapi-config"
```

This is the contents of the published config file:


```php
return [
    'api_token' => env('WAAPI_API_TOKEN'),
    'instance_id' => env('WAAPI_INSTANCE_ID'),
];
```

Please adapt your .env with your instance ID and Token which can be obtained from your [API Tokens](https://waapi.app/user/api-tokens) 

Replace with your token and your instance ID 
```dotenv
WAAPI_API_TOKEN=abcdefghijklmop
WAAPI_INSTANCE_ID=123
```

## Usage

```php
$waAPI = new WaAPI\WaAPI();
$waAPI->sendMessage('1222333444@c.us', 'Hello there!');
```

### Webhook Listener

Create an event listener to listen on the webhook events

new Message example:

```bash
php artisan make:listener WaAPIMessageListener --event=\\WaAPI\\WaAPI\\Events\\MessageEvent
```

QR Code change example:

```bash
php artisan make:listener WaAPIQrCodeListener --event=\\WaAPI\\WaAPI\\Events\\QrEvent
```

Register your listener in `app/Providers/EventServiceProvider.php` if autodiscovery for events is disabled

```php
    use App\Listeners\WaAPIInstanceReadyListener;
    use App\Listeners\WaAPIMessageListener;
    use WaAPI\WaAPI\Events\MessageEvent;
    use WaAPI\WaAPI\Events\QrEvent;
        
    [...]
        
    protected $listen = [
        MessageEvent::class => [
            WaAPIMessageListener::class,
        ],
        QrEvent::class => [
            WaAPIQrCodeListener::class,
        ],
    ];
```

Example for `WaAPIMessageListener`:

```php
<?php

namespace App\Listeners;

use WaAPI\WaAPI\Events\MessageEvent;
use WaAPI\WaAPI\WaAPI;

class WaAPIMessageListener
{
    /**
     * Handle the event.
     */
    public function handle(MessageEvent $message): void
    {
        if (!$message->isFromMe()) {
            app(WaAPI::class)->sendMessage($message->getFrom(), 'Hello to you too!');
        }
    }
}

```




### Available events:

```
AuthenticatedEvent
AuthFailureEvent
DisconnectedEvent
GroupJoinEvent
GroupLeaveEvent
GroupUpdateEvent
InstanceReadyEvent
LoadingScreenEvent
MediaUploadedEvent
MessageAcknowledgedEvent
MessageCreatedEvent
MessageEvent
MessageReactionEvent
MessageRevokedEveryoneEvent
MessageRevokedMeEvent
QrEvent
StateChangeEvent
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
