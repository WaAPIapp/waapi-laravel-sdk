<?php

namespace WaAPI\WaAPI\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use WaAPI\WaAPI\WaAPIServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

    }

    protected function getPackageProviders($app)
    {
        return [
            WaAPIServiceProvider::class,
        ];
    }
}

