<?php

namespace WaAPIapp\WaapiLaravelSdk;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use WaAPIapp\WaapiLaravelSdk\Commands\WaapiLaravelSdkCommand;

class WaapiLaravelSdkServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('waapi-laravel-sdk')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_waapi-laravel-sdk_table')
            ->hasCommand(WaapiLaravelSdkCommand::class);
    }
}
