<?php

namespace WaAPI\WaAPI\Http\Controllers;

use WaAPI\WaAPI\Enum\EventType;
use WaAPI\WaAPI\Events\AuthenticatedEvent;
use WaAPI\WaAPI\Events\AuthFailureEvent;
use WaAPI\WaAPI\Events\DisconnectedEvent;
use WaAPI\WaAPI\Events\GroupJoinEvent;
use WaAPI\WaAPI\Events\GroupLeaveEvent;
use WaAPI\WaAPI\Events\GroupUpdateEvent;
use WaAPI\WaAPI\Events\InstanceReadyEvent;
use WaAPI\WaAPI\Events\LoadingScreenEvent;
use WaAPI\WaAPI\Events\MediaUploadedEvent;
use WaAPI\WaAPI\Events\MessageAcknowledgedEvent;
use WaAPI\WaAPI\Events\MessageCreatedEvent;
use WaAPI\WaAPI\Events\MessageEvent;
use WaAPI\WaAPI\Events\MessageReactionEvent;
use WaAPI\WaAPI\Events\MessageRevokedEveryoneEvent;
use WaAPI\WaAPI\Events\MessageRevokedMeEvent;
use WaAPI\WaAPI\Events\QrEvent;
use WaAPI\WaAPI\Events\StateChangeEvent;

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
            EventType::MESSAGE => MessageEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::QR => QrEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::AUTHENTICATED => AuthenticatedEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::AUTH_FAILURE => AuthFailureEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::READY => InstanceReadyEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::MESSAGE_CREATED => MessageCreatedEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::MESSAGE_REVOKED_EVERYONE => MessageRevokedEveryoneEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::MESSAGE_REVOKED_ME => MessageRevokedMeEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::MESSAGE_ACKNOWLEDGED => MessageAcknowledgedEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::MESSAGE_REACTION => MessageReactionEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::MEDIA_UPLOADED => MediaUploadedEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::GROUP_JOIN => GroupJoinEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::GROUP_LEAVE => GroupLeaveEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::GROUP_UPDATE => GroupUpdateEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::DISCONNECTED => DisconnectedEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::CHANGE_STATE => StateChangeEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            ),
            EventType::LOADING_SCREEN => LoadingScreenEvent::dispatch(
                $eventType,
                $instanceId,
                $eventData
            )
        };

    }
}
