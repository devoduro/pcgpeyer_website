<?php

namespace App\Support;

/** Sends push notifications to the mobile app. Swapped for a fake in tests. */
interface PushNotifier
{
    /** True when the server has what it needs to send (e.g. the Firebase key is installed). */
    public function isConfigured(): bool;

    /** @throws \RuntimeException when sending fails */
    public function sendToTopic(string $topic, string $title, string $body, array $data = [], ?string $imageUrl = null): void;
}
