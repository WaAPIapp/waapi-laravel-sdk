<?php

namespace WaAPI\WaAPI\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \WaAPI\WaAPI\WaAPI
 */
class WaAPI extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'waapi';
    }
}
