<?php

namespace WaAPI\WaAPI;

use WaAPI\WaAPI\Action\Actions;
use WaAPI\WaAPISdk\WaAPISdk;

class WaAPI
{
    use Actions;

    /**
     * @var WaAPISdk
     */
    private WaAPISdk $sdk;

    /**
     * @var int|null
     */
    private ?int $instanceId;

    /**
     * @param int|null $instanceId
     */
    public function __construct(int $instanceId = null)
    {
        $this->sdk = new WaAPISdk(config('waapi.api_token'));
        $this->instanceId = $instanceId ?? config('waapi.instance_id');
    }

    /**
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|int|mixed|null
     */
    public function getInstanceId()
    {
        return $this->instanceId;
    }

    /**
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \WaAPI\WaAPISdk\Exceptions\FailedActionException
     * @throws \WaAPI\WaAPISdk\Exceptions\NotFoundException
     * @throws \WaAPI\WaAPISdk\Exceptions\ValidationException
     */
    public function executeAction(string $action, array $payload, int $instanceId = null)
    {
        return $this->sdk->executeInstanceAction($instanceId ?? $this->instanceId, $action, $payload);
    }

    /**
     * @return \WaAPI\WaAPISdk\Resources\Instance[]
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \WaAPI\WaAPISdk\Exceptions\FailedActionException
     * @throws \WaAPI\WaAPISdk\Exceptions\NotFoundException
     * @throws \WaAPI\WaAPISdk\Exceptions\ValidationException
     */
    public function getInstances()
    {
        return $this->sdk->instances();
    }

    /**
     * @return \WaAPI\WaAPISdk\Resources\Instance
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \WaAPI\WaAPISdk\Exceptions\FailedActionException
     * @throws \WaAPI\WaAPISdk\Exceptions\NotFoundException
     * @throws \WaAPI\WaAPISdk\Exceptions\ValidationException
     */
    public function getInstanceById(int $instanceId)
    {
        return $this->sdk->getInstance($instanceId);
    }

    /**
     * @return \WaAPI\WaAPISdk\Resources\Instance
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \WaAPI\WaAPISdk\Exceptions\FailedActionException
     * @throws \WaAPI\WaAPISdk\Exceptions\NotFoundException
     * @throws \WaAPI\WaAPISdk\Exceptions\ValidationException
     */
    public function createInstance()
    {
        return $this->sdk->createInstance();
    }

    /**
     * @return \WaAPI\WaAPISdk\Resources\InstanceClientStatus
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \WaAPI\WaAPISdk\Exceptions\FailedActionException
     * @throws \WaAPI\WaAPISdk\Exceptions\NotFoundException
     * @throws \WaAPI\WaAPISdk\Exceptions\ValidationException
     */
    public function updateInstance(string $webhookUrl, array $webhookEvents, int $instanceId = null)
    {
        return $this->sdk->updateInstance($instanceId ?? $this->instanceId, $webhookUrl, $webhookEvents);
    }

    /**
     * @return void
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \WaAPI\WaAPISdk\Exceptions\FailedActionException
     * @throws \WaAPI\WaAPISdk\Exceptions\NotFoundException
     * @throws \WaAPI\WaAPISdk\Exceptions\ValidationException
     */
    public function deleteInstance(int $instanceId = null)
    {
        $this->sdk->deleteInstance($instanceId ?? $this->instanceId);
    }

    /**
     * @return \WaAPI\WaAPISdk\Resources\InstanceClientStatus
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \WaAPI\WaAPISdk\Exceptions\FailedActionException
     * @throws \WaAPI\WaAPISdk\Exceptions\NotFoundException
     * @throws \WaAPI\WaAPISdk\Exceptions\ValidationException
     */
    public function getInstanceStatus(int $instanceId = null)
    {
        return $this->sdk->getInstanceClientStatus($instanceId ?? $this->instanceId);
    }

    /**
     * @return \WaAPI\WaAPISdk\Resources\InstanceClientQrCode
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \WaAPI\WaAPISdk\Exceptions\FailedActionException
     * @throws \WaAPI\WaAPISdk\Exceptions\NotFoundException
     * @throws \WaAPI\WaAPISdk\Exceptions\ValidationException
     */
    public function getInstanceQrCode(int $instanceId = null)
    {
        return $this->sdk->getInstanceClientQrCode($instanceId ?? $this->instanceId);
    }

    /**
     * @return \WaAPI\WaAPISdk\Resources\InstanceClientMe
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \WaAPI\WaAPISdk\Exceptions\FailedActionException
     * @throws \WaAPI\WaAPISdk\Exceptions\NotFoundException
     * @throws \WaAPI\WaAPISdk\Exceptions\ValidationException
     */
    public function getInstanceInfo(int $instanceId = null)
    {
        return $this->sdk->getInstanceClientInfo($instanceId ?? $this->instanceId);
    }
}
