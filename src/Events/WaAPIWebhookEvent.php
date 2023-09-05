<?php

namespace WaAPI\WaAPI\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WaAPIWebhookEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        public string $type,
        public int   $instanceId,
        public array  $data,
    )
    {
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getInstanceId(): bool
    {
        return $this->instanceId;
    }

    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('waapi');
    }
}
