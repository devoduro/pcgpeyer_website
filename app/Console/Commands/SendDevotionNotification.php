<?php

namespace App\Console\Commands;

use App\Models\Devotional;
use App\Support\DevotionNotifier;
use App\Support\DevotionService;
use Illuminate\Console\Command;
use Throwable;

/**
 * Sends today's devotion push to every app install. Scheduled every 15 minutes during the
 * morning window, so a server that was off at the start still sends once it is back, and a
 * devotional published later in the morning still goes out. Each devotional is sent only once.
 */
class SendDevotionNotification extends Command
{
    protected $signature = 'devotions:notify {--date= : Church date (Y-m-d), default today} {--force : Send even if already sent}';

    protected $description = "Send today's devotional as a push notification to everyone with the app";

    public function handle(DevotionService $devotions, DevotionNotifier $notifier): int
    {
        $date = $this->option('date') ?: $devotions->today();
        $devotional = Devotional::where('published', true)->whereDate('publish_date', $date)->first();

        if (! $devotional) {
            $this->info("No published devotional for $date; nothing to send.");

            return self::SUCCESS;
        }

        try {
            $sent = $notifier->send($devotional, (bool) $this->option('force'));
        } catch (Throwable $e) {
            report($e);
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        $this->info($sent ? "Sent: {$devotional->title}" : 'Already sent, or notifications are off for this devotional.');

        return self::SUCCESS;
    }
}
