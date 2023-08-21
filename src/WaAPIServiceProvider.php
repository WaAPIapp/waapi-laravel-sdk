<?php

namespace WaAPI\WaAPI;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use WaAPI\WaAPI\Commands\WaAPICommand;

class WaAPIServiceProvider extends PackageServiceProvider
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
            ->hasCommand(WaAPICommand::class);
    }
}
