<?php

namespace App\Console;

use App\Jobs\UpdateAvgRating;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('update:avg-rating')->timezone('Asia/Jakarta')->twiceDaily(12, 0)->runInBackground();
        // $schedule->command('update:avg-rating')->everyMinute();
        $schedule->job(new UpdateAvgRating())->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
