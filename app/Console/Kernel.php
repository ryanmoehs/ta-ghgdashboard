<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */

    protected $commands = [
        \App\Console\Commands\GenerateFuelCombustionActivity::class,
        \App\Console\Commands\AggregateDailyEmissions::class,
    ];
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('app:generate-fuel-combustion-activity')->everySecond();
        $schedule->command('emissions:aggregate-daily')->daily();
        // $schedule->command('emissions:aggregate-monthly')->monthly();
        // $schedule->command('emissions:generate-report')->monthlyOn(1, '02:00');
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
