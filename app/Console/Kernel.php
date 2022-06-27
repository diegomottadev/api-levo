<?php

namespace App\Console;

use App\Jobs\WarningToAdminJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     * php artisan migrate
     * php artisan db:seed
     * php artisan --env=testing migrate
     * php artisan schedule:work
     * php artisan queue:work
     *

     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        //$schedule->job(new WarningToAdminJob())->dailyAt('8:00');
        $schedule->job(new WarningToAdminJob())->everyMinute();


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
