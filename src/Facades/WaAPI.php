<?php

namespace WaAPI\WaAPI\Facades;

use Illuminate\Support\Facades\Facade;

class WaAPI extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \WaAPI\WaAPI\WaAPI::class;
    }
}
