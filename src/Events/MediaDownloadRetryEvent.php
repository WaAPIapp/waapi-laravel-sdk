<?php

namespace WaAPI\WaAPI\Events;

/**
 * Fired once for an incoming media message whose download had failed: `data.media` carries the
 * file after a successful retry, or `{status: 'error', error, detail, final: true}`; `data.retry`
 * says which (`outcome`: delivered or failed). Opt-in on the instance or a webhook subscription.
 */
class MediaDownloadRetryEvent extends WaAPIEvent {}
