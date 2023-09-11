<?php

namespace WaAPI\WaAPI;

use WaAPI\WaAPI\Action\Actions;
use WaAPI\WaAPISdk\WaAPISdk;

class WaAPI
{
    use Actions;

    private WaAPISdk $sdk;

    private ?int $instanceId;

    /**
     * Construct a new instance of the class.
     *
     * @param int|null $instanceId The instance ID. If not provided, the default instance ID will be used.
     */
    public function __construct(int $instanceId = null)
    {
        // Create a new instance of the WaAPISdk class using the API token from the configuration.
        $this->sdk = new WaAPISdk(config('waapi.api_token'));

        // Assign the provided instance ID, or use the default instance ID from the configuration.
        $this->instanceId = $instanceId ?? config('waapi.instance_id');
    }

    /**
     * Get the instance ID.
     *
     * @return int|null The instance ID.
     */
    public function getInstanceId()
    {
        return $this->instanceId;
    }

    /**
     * Executes an action on a Workflow Automation (WaAPI) instance.
     *
     * @param string $action The action to be executed.
     * @param array $payload The payload for the action.
     * @param int|null $instanceId The instance ID. If null, uses the default instance ID.
     * @return \WaAPI\WaAPISdk\Resources\ExecutedAction The executed action.
     * @throws \GuzzleHttp\Exception\GuzzleException If there is an error with the HTTP request.
     * @throws \WaAPI\WaAPISdk\Exceptions\FailedActionException If the action fails to execute.
     * @throws \WaAPI\WaAPISdk\Exceptions\NotFoundException If the instance is not found.
     * @throws \WaAPI\WaAPISdk\Exceptions\ValidationException If the payload is invalid.
     */
    public function executeAction(string $action, array $payload, int $instanceId = null)
    {
        // Execute the action using the instance ID, or the default instance ID if null.
        return $this->sdk->executeInstanceAction($instanceId ?? $this->instanceId, $action, $payload);
    }

    /**
     * Retrieves a list of instances from the API.
     *
     * @return \WaAPI\WaAPISdk\Resources\Instance[] An array of instances.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException If there is an error making the HTTP request.
     * @throws \WaAPI\WaAPISdk\Exceptions\FailedActionException If the API request fails.
     * @throws \WaAPI\WaAPISdk\Exceptions\NotFoundException If the requested resource is not found.
     * @throws \WaAPI\WaAPISdk\Exceptions\ValidationException If there is an error with the request parameters.
     */
    public function getInstances()
    {
        return $this->sdk->instances();
    }

    /**
     * Get an instance by ID.
     *
     * @param int $instanceId The ID of the instance to retrieve.
     * @return \WaAPI\WaAPISdk\Resources\Instance The retrieved instance.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException If there is an error with the HTTP request.
     * @throws \WaAPI\WaAPISdk\Exceptions\FailedActionException If the action fails.
     * @throws \WaAPI\WaAPISdk\Exceptions\NotFoundException If the instance is not found.
     * @throws \WaAPI\WaAPISdk\Exceptions\ValidationException If there is a validation error.
     */
    public function getInstanceById(int $instanceId)
    {
        return $this->sdk->getInstance($instanceId);
    }

    /**
     * Create an instance using the WaAPISdk.
     *
     * @return \WaAPI\WaAPISdk\Resources\Instance The created instance.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException If an error occurs during the API request.
     * @throws \WaAPI\WaAPISdk\Exceptions\FailedActionException If the action fails.
     * @throws \WaAPI\WaAPISdk\Exceptions\NotFoundException If the requested resource is not found.
     * @throws \WaAPI\WaAPISdk\Exceptions\ValidationException If the input data is invalid.
     */
    public function createInstance()
    {
        return $this->sdk->createInstance();
    }

    /**
     * Updates the instance with the specified webhook URL and webhook events.
     *
     * @param string $webhookUrl The URL to which webhooks will be sent.
     * @param array $webhookEvents An array of webhook events.
     * @param int|null $instanceId (optional) The ID of the instance to update. If not provided, the default instance ID will be used.
     *
     * @return \WaAPI\WaAPISdk\Resources\InstanceClientStatus The updated instance client status.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException If there is an error with the HTTP request.
     * @throws \WaAPI\WaAPISdk\Exceptions\FailedActionException If the action fails for any reason.
     * @throws \WaAPI\WaAPISdk\Exceptions\NotFoundException If the instance is not found.
     * @throws \WaAPI\WaAPISdk\Exceptions\ValidationException If the input validation fails.
     */
    public function updateInstance(string $webhookUrl, array $webhookEvents, int $instanceId = null)
    {
        return $this->sdk->updateInstance($instanceId ?? $this->instanceId, $webhookUrl, $webhookEvents);
    }

    /**
     * Delete an instance.
     *
     * @param int|null $instanceId The ID of the instance to delete. If null, the instance ID from the class property will be used.
     *
     * @return void
     *
     * @throws \GuzzleHttp\Exception\GuzzleException If an error occurs while making the API request.
     * @throws \WaAPI\WaAPISdk\Exceptions\FailedActionException If the API request to delete the instance fails.
     * @throws \WaAPI\WaAPISdk\Exceptions\NotFoundException If the instance is not found.
     * @throws \WaAPI\WaAPISdk\Exceptions\ValidationException If the instance ID is invalid.
     */
    public function deleteInstance(int $instanceId = null)
    {
        $this->sdk->deleteInstance($instanceId ?? $this->instanceId);
    }

    /**
     * Get the status of an instance.
     *
     * @param int|null $instanceId The ID of the instance. If null, the default instance ID will be used.
     * @return \WaAPI\WaAPISdk\Resources\InstanceClientStatus The instance status.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException If there is an error making the request.
     * @throws \WaAPI\WaAPISdk\Exceptions\FailedActionException If the action fails.
     * @throws \WaAPI\WaAPISdk\Exceptions\NotFoundException If the instance is not found.
     * @throws \WaAPI\WaAPISdk\Exceptions\ValidationException If there is a validation error.
     */
    public function getInstanceStatus(int $instanceId = null)
    {
        return $this->sdk->getInstanceClientStatus($instanceId ?? $this->instanceId);
    }

    /**
     * Get the QR code for an instance.
     *
     * @param int|null $instanceId The ID of the instance. If not provided, the default instance ID will be used.
     * @return \WaAPI\WaAPISdk\Resources\InstanceClientQrCode The QR code for the instance.
     * @throws \GuzzleHttp\Exception\GuzzleException If there is an error with the HTTP request.
     * @throws \WaAPI\WaAPISdk\Exceptions\FailedActionException If the action fails.
     * @throws \WaAPI\WaAPISdk\Exceptions\NotFoundException If the instance is not found.
     * @throws \WaAPI\WaAPISdk\Exceptions\ValidationException If there is a validation error.
     */
    public function getInstanceQrCode(int $instanceId = null)
    {
        return $this->sdk->getInstanceClientQrCode($instanceId ?? $this->instanceId);
    }

    /**
     * Get the instance information.
     *
     * @param int|null $instanceId The instance ID. If not provided, the default instance ID will be used.
     *
     * @return \WaAPI\WaAPISdk\Resources\InstanceClientMe The instance client object.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException If there is an error with the HTTP request.
     * @throws \WaAPI\WaAPISdk\Exceptions\FailedActionException If the action fails.
     * @throws \WaAPI\WaAPISdk\Exceptions\NotFoundException If the instance is not found.
     * @throws \WaAPI\WaAPISdk\Exceptions\ValidationException If there is a validation error.
     */
    public function getInstanceInfo(int $instanceId = null)
    {
        // Get the instance client information using the SDK.
        return $this->sdk->getInstanceClientInfo($instanceId ?? $this->instanceId);
    }
}
