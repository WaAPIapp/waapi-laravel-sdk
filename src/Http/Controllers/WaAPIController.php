<?php

namespace WaAPI\WaAPI\Http\Controllers;

use WaAPI\WaAPI\Events\WaAPIWebhookEvent;

class WaAPIController
{

    /**
     * @return void
     */
    public function handleWebhook()
    {
        $data = request()->all();

        WaAPIWebhookEvent::dispatch(
            $data['event'] ?? 'unknown',
            $data['instanceId'] ?? 0,
            $data['data'] ?? [],
        );

    }

}
