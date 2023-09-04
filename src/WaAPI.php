<?php

namespace WaAPI\WaAPI;

use WaAPI\WaAPI\Action\Actions;
use WaAPI\WaAPISdk\WaAPISdk;

class WaAPI
{
    use Actions;

    private WaAPISdk $sdk;

    private ?int $instanceId;

    public function __construct(int $instanceId = null)
    {
        $this->sdk = new WaAPISdk(config('waapi.api_token'));
        $this->instanceId = $instanceId ?? config('waapi.instance_id');
    }

    public function getInstanceId()
    {
        return $this->instanceId;
    }

    public function executeAction(string $action, array $payload, int $instanceId = null)
    {
        return $this->sdk->executeInstanceAction($instanceId ?? $this->instanceId, $action, $payload);
    }

    public function getInstances()
    {
        return $this->sdk->instances();
    }

    public function getInstanceById(int $instanceId)
    {
        return $this->sdk->getInstance($instanceId);
    }

    public function createInstance()
    {
        return $this->sdk->createInstance();
    }

    public function updateInstance(string $webhookUrl, array $webhookEvents, int $instanceId = null)
    {
        return $this->sdk->updateInstance($instanceId ?? $this->instanceId, $webhookUrl, $webhookEvents);
    }

    public function deleteInstance(int $instanceId = null)
    {
        $this->sdk->deleteInstance($instanceId ?? $this->instanceId);
    }

    public function getInstanceStatus(int $instanceId = null)
    {
        return $this->sdk->getInstanceClientStatus($instanceId ?? $this->instanceId);
    }

    public function getInstanceQrCode(int $instanceId = null)
    {
        return $this->sdk->getInstanceClientQrCode($instanceId ?? $this->instanceId);
    }

    public function getInstanceInfo(int $instanceId = null)
    {
        return $this->sdk->getInstanceClientInfo($instanceId ?? $this->instanceId);
    }
}
