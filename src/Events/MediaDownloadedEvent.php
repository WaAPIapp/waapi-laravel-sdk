<?php

namespace WaAPI\WaAPI\Events;

/**
 * Fired once for an incoming media message as soon as its file is available, on the first download
 * or after a retry. Carries `data.message` only: fetch the file with downloadMedia(). Opt-in on the
 * instance or a webhook subscription; needs a message event subscribed too.
 */
class MediaDownloadedEvent extends WaAPIEvent {}
