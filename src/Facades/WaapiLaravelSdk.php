<?php

namespace WaAPIapp\WaapiLaravelSdk\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \WaAPIapp\WaapiLaravelSdk\WaapiLaravelSdk
 */
class WaapiLaravelSdk extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \WaAPIapp\WaapiLaravelSdk\WaapiLaravelSdk::class;
    }
}
