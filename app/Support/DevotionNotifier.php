<?php

namespace App\Support;

use App\Models\Devotional;

/** Builds and sends the morning "today's devotion" push, at most once per devotional. */
class DevotionNotifier
{
    public function __construct(private PushNotifier $push)
    {
    }

    public function title(Devotional $d): string
    {
        return $d->notification_title ?: "Today's devotion";
    }

    public function body(Devotional $d): string
    {
        return $d->notification_body ?: "{$d->title} · {$d->scripture_reference}";
    }

    /**
     * Sends the push for this devotional. Skips drafts, days with notifications switched off,
     * and devotionals already sent, unless $force is set (the admin's "Send again").
     * Returns true when a notification went out.
     */
    public function send(Devotional $d, bool $force = false): bool
    {
        if (! $d->published || (! $force && (! $d->notify || $d->notified_at))) {
            return false;
        }

        $this->push->sendToTopic(config('firebase.devotion_topic'), $this->title($d), $this->body($d), [
            'type' => 'devotion',
            'devotional_id' => $d->id,
            'date' => $d->publish_date->toDateString(),
        ], $d->thumbnail ? asset('storage/' . $d->thumbnail) : null);

        $d->forceFill(['notified_at' => now()])->save();

        return true;
    }
}
