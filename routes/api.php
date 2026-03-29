<?php

use Illuminate\Support\Facades\Route;
use WaAPI\WaAPI\Http\Controllers\WaAPIController;

Route::post('/waapi/webhooks', [WaAPIController::class, 'handleWebhook'])->name('waapi.webhooks');
