<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Morning devotion push. Checked every 15 minutes in the window; each devotional is sent once,
        // so a missed start (server off) or a devotional published mid-morning still goes out.
        $schedule->command('devotions:notify')
            ->everyFifteenMinutes()
            ->between(config('devotion.notify_from'), config('devotion.notify_until'))
            ->timezone(config('devotion.timezone'))
            ->withoutOverlapping();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
