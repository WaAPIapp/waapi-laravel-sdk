<?php

namespace WaAPI\WaAPI\Events;

/**
 * An incoming call on an instance whose call policy connects calls to a voice agent
 * of type `websocket_inbound` is ready to be streamed.
 *
 * `getData()` holds:
 *  - `callId` (string): the call.
 *  - `caller` (string|null): the caller's number, digits only, or null if unknown.
 *  - `streamUrl` (string): `wss://…/v1/stream?token=…`.
 *  - `expiresInSeconds` (int): how long the URL is valid.
 *
 * Your voice agent has to open a WebSocket to `streamUrl` within `expiresInSeconds`.
 * The token in the URL is single-use and works like a credential: never log the URL.
 */
class CallStreamReadyEvent extends WaAPIEvent {}
