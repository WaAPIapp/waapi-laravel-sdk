<?php

namespace WaAPI\WaAPI\Http\Controllers;

use PHPUnit\Event\UnknownEventException;
use WaAPI\WaAPI\Enum\EventType;
use WaAPI\WaAPI\Events\WaAPIAuthenticatedEvent;
use WaAPI\WaAPI\Events\WaAPIAuthFailureEvent;
use WaAPI\WaAPI\Events\WaAPIDisconnectedEvent;
use WaAPI\WaAPI\Events\WaAPIGroupJoinEvent;
use WaAPI\WaAPI\Events\WaAPIGroupLeaveEvent;
use WaAPI\WaAPI\Events\WaAPIGroupUpdateEvent;
use WaAPI\WaAPI\Events\WaAPIInstanceReadyEvent;
use WaAPI\WaAPI\Events\WaAPILoadingScreenEvent;
use WaAPI\WaAPI\Events\WaAPIMediaUploadedEvent;
use WaAPI\WaAPI\Events\WaAPIMessageAcknowledgedEvent;
use WaAPI\WaAPI\Events\WaAPIMessageCreatedEvent;
use WaAPI\WaAPI\Events\WaAPIMessageEvent;
use WaAPI\WaAPI\Events\WaAPIMessageReactionEvent;
use WaAPI\WaAPI\Events\WaAPIMessageRevokedEveryoneEvent;
use WaAPI\WaAPI\Events\WaAPIMessageRevokedMeEvent;
use WaAPI\WaAPI\Events\WaAPIQrEvent;
use WaAPI\WaAPI\Events\WaAPIStateChangeEvent;

class WaAPIController
{
    /**
     * @return void
     */
    public function handleWebhook()
    {
        $data = request()->all();
        $eventType = EventType::from($data['event']);

        $eventData = $data['data'] ?: null;
        $instanceId = $data['instanceId'];

        match ($eventType) {
            EventType::MESSAGE => WaAPIMessageEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::QR => WaAPIQrEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::AUTHENTICATED => WaAPIAuthenticatedEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::AUTH_FAILURE => WaAPIAuthFailureEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::READY => WaAPIInstanceReadyEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::MESSAGE_CREATED => WaAPIMessageCreatedEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::MESSAGE_REVOKED_EVERYONE => WaAPIMessageRevokedEveryoneEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::MESSAGE_REVOKED_ME => WaAPIMessageRevokedMeEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::MESSAGE_ACKNOWLEDGED => WaAPIMessageAcknowledgedEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::MESSAGE_REACTION => WaAPIMessageReactionEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::MEDIA_UPLOADED => WaAPIMediaUploadedEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::GROUP_JOIN => WaAPIGroupJoinEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::GROUP_LEAVE => WaAPIGroupLeaveEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::GROUP_UPDATE => WaAPIGroupUpdateEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::DISCONNECTED => WaAPIDisconnectedEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::CHANGE_STATE => WaAPIStateChangeEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::LOADING_SCREEN => WaAPILoadingScreenEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            )
        };

    }
}
