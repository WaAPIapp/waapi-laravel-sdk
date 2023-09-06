# WaAPI Laravel Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/waapi/waapi-laravel-sdk.svg?style=flat-square)](https://packagist.org/packages/waapi/waapi-laravel-sdk)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/waapi/waapi-laravel-sdk/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/waapi/waapi-laravel-sdk/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/waapi/waapi-laravel-sdk/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/waapi/waapi-laravel-sdk/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/waapi/waapi-laravel-sdk.svg?style=flat-square)](https://packagist.org/packages/waapi/waapi-laravel-sdk)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/waapi-laravel-sdk.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/waapi-laravel-sdk)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can
support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.
You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards
on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require waapi/waapi-laravel-sdk
```

You can publish and run the migrations with:


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
