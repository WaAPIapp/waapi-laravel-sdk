<?php

namespace WaAPI\WaAPI\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use WaAPI\WaAPI\Enum\EventType;

class WaAPIEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public EventType $type,
        public int $instanceId,
        public ?array $data = null,
    ) {
        Log::info('created event: '.get_class($this));
    }

    public function getType(): EventType
    {
        return $this->type;
    }

    public function getInstanceId(): int
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
