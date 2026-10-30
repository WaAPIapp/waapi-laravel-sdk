<?php

declare(strict_types=1);

namespace WaAPI\WaAPI\Tests;

use Illuminate\Support\Facades\Event;
use WaAPI\WaAPI\Enum\EventType;
use WaAPI\WaAPI\Events\MediaDownloadedEvent;
use WaAPI\WaAPI\Events\MediaDownloadRetryEvent;

class WebhookEventsTest extends TestCase
{
    public function test_a_media_download_retry_webhook_dispatches_its_event(): void
    {
        Event::fake();

        $this->postJson('/waapi/webhooks', [
            'event' => 'media_download_retry',
            'instanceId' => '102664',
            'data' => [
                'message' => ['id' => ['_serialized' => 'false_491700000002@c.us_3A0000000000000000AA']],
                'media' => ['mimetype' => 'image/jpeg', 'data' => 'AAAA', 'filename' => null, 'filesize' => 3],
                'retry' => ['outcome' => 'delivered', 'attempts' => 1, 'firstFailedAt' => '2026-10-30T12:00:00Z', 'firstError' => 'timed_out', 'originalEvent' => 'message'],
            ],
        ])->assertOk();

        Event::assertDispatched(MediaDownloadRetryEvent::class, function (MediaDownloadRetryEvent $event): bool {
            return $event->getType() === EventType::MEDIA_DOWNLOAD_RETRY
                && $event->getInstanceId() === 102664
                && $event->getData()['retry']['outcome'] === 'delivered';
        });
    }

    public function test_a_media_downloaded_webhook_dispatches_its_event(): void
    {
        Event::fake();

        $this->postJson('/waapi/webhooks', [
            'event' => 'media_downloaded',
            'instanceId' => '102664',
            'data' => [
                'message' => ['id' => ['_serialized' => 'false_491700000002@lid_2A8F818580737FFA5AE0'], 'type' => 'image'],
            ],
        ])->assertOk();

        Event::assertDispatched(MediaDownloadedEvent::class, function (MediaDownloadedEvent $event): bool {
            return $event->getType() === EventType::MEDIA_DOWNLOADED
                && $event->getInstanceId() === 102664
                && $event->getData()['message']['id']['_serialized'] === 'false_491700000002@lid_2A8F818580737FFA5AE0';
        });
    }
}
