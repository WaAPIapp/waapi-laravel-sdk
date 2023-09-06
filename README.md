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

## Usage

```php
$waAPI = new WaAPI\WaAPI();
$waAPI->sendMessage('1222333444@c.us', 'Hello there!');
```

Create a event listener to listen on the webhook events

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

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [WaAPI](https://github.com/WaAPIapp)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
