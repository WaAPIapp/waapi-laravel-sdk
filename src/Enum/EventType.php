<?php

namespace WaAPI\WaAPI\Enum;

enum EventType: string
{
    case MESSAGE = 'message';
    case QR = 'qr';
    case AUTHENTICATED = 'authenticated';
    case AUTH_FAILURE = 'auth_failure';
    case READY = 'ready';
    case MESSAGE_CREATED = 'message_create';
    case MESSAGE_REVOKED_EVERYONE = 'message_revoke_everyone';
    case MESSAGE_REVOKED_ME = 'message_revoke_me';
    case MESSAGE_ACKNOWLEDGED = 'message_ack';
    case MESSAGE_REACTION = 'message_reaction';
    case MEDIA_UPLOADED = 'media_uploaded';
    case GROUP_JOIN = 'group_join';
    case GROUP_LEAVE = 'group_leave';
    case GROUP_UPDATE = 'group_update';
    case DISCONNECTED = 'disconnected';
    case CHANGE_STATE = 'change_state';
    case LOADING_SCREEN = 'loading_screen';
}
