<?php

\Illuminate\Support\Facades\Route::post('/waapi/webhooks', [\WaAPI\WaAPI\Http\Controllers\WaAPIController::class, 'handleWebhook'])->name('waapi.webhooks');

