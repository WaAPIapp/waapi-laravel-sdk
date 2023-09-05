<?php

namespace WaAPI\WaAPI;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class WaAPIServiceProvider extends PackageServiceProvider
{
    public function boot()
    {
        $this->app->bind('waapi', function () {
            return new WaAPI();
        });
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('waapi-laravel-sdk')
            ->hasRoute('api')
            ->hasConfigFile('waapi');
    }
}
