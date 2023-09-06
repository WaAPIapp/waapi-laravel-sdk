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

        match ($eventType) {
            EventType::MESSAGE => WaAPIMessageEvent::dispatch(
                $eventType,
                $data['instanceId'],
                $data['data']
            ),
            EventType::QR => WaAPIQrEvent::dispatch(
                $eventType,
                $data['instanceId'],
                $data['data']
            ),
            EventType::AUTHENTICATED => WaAPIAuthenticatedEvent::dispatch(
                $eventType,
                $data['instanceId'],
                $data['data']
            ),
            EventType::AUTH_FAILURE => WaAPIAuthFailureEvent::dispatch(
                $eventType,
                $data['instanceId'],
                $data['data']
            ),
            EventType::READY => WaAPIInstanceReadyEvent::dispatch(
                $eventType,
                $data['instanceId'],
                $data['data']
            ),
            EventType::MESSAGE_CREATED => WaAPIMessageCreatedEvent::dispatch(
                $eventType,
                $data['instanceId'],
                $data['data']
            ),
            EventType::MESSAGE_REVOKED_EVERYONE => WaAPIMessageRevokedEveryoneEvent::dispatch(
                $eventType,
                $data['instanceId'],
                $data['data']
            ),
            EventType::MESSAGE_REVOKED_ME => WaAPIMessageRevokedMeEvent::dispatch(
                $eventType,
                $data['instanceId'],
                $data['data']
            ),
            EventType::MESSAGE_ACKNOWLEDGED => WaAPIMessageAcknowledgedEvent::dispatch(
                $eventType,
                $data['instanceId'],
                $data['data']
            ),
            EventType::MESSAGE_REACTION => WaAPIMessageReactionEvent::dispatch(
                $eventType,
                $data['instanceId'],
                $data['data']
            ),
            EventType::MEDIA_UPLOADED => WaAPIMediaUploadedEvent::dispatch(
                $eventType,
                $data['instanceId'],
                $data['data']
            ),
            EventType::GROUP_JOIN => WaAPIGroupJoinEvent::dispatch(
                $eventType,
                $data['instanceId'],
                $data['data']
            ),
            EventType::GROUP_LEAVE => WaAPIGroupLeaveEvent::dispatch(
                $eventType,
                $data['instanceId'],
                $data['data']
            ),
            EventType::GROUP_UPDATE => WaAPIGroupUpdateEvent::dispatch(
                $eventType,
                $data['instanceId'],
                $data['data']
            ),
            EventType::DISCONNECTED => WaAPIDisconnectedEvent::dispatch(
                $eventType,
                $data['instanceId'],
                $data['data']
            ),
            EventType::CHANGE_STATE => WaAPIStateChangeEvent::dispatch(
                $eventType,
                $data['instanceId'],
                $data['data']
            ),
            EventType::LOADING_SCREEN => WaAPILoadingScreenEvent::dispatch(
                $eventType,
                $data['instanceId'],
                $data['data']
            ),
            default => throw new UnknownEventException()
        };

    }
}
