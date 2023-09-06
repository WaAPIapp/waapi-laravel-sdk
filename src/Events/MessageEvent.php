<?php

namespace WaAPI\WaAPI\Events;

class MessageEvent extends WaAPIEvent
{
    public function getFrom(): ?string
    {
        return $this->getData()['message']['_data']['from'] ?? null;
    }

    public function getTo(): ?string
    {
        return $this->getData()['message']['_data']['to'] ?? null;
    }

    public function isFromMe(): bool
    {
        return $this->getData()['message']['_data']['fromMe'] ?? false;
    }

    public function getMessage(): ?string
    {
        return $this->getData()['message']['_data']['body'] ?? null;
    }

    public function getMessageType(): ?string
    {
        return $this->getData()['message']['_data']['type'] ?? null;
    }

    public function getMessageId(): ?string
    {
        return $this->getData()['message']['_data']['id']['_serialized'] ?? null;
    }

    public function isAcknowledged(): bool
    {
        return $this->getData()['message']['_data']['ack'] ?? false;
    }
}
