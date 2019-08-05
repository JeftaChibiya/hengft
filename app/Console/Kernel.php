<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

 
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {   
        /** delete day-old tips and inplay tips */
        $schedule->command('tips:delete-old-tips')->dailyAt('11:59'); 
        
        /** send email to user: account about to be deleted */        
        $schedule->command('subscriber:deletion-notification')->hourly();

        /** delete user with cancelled subscription */        
        $schedule->command('delete:cancelled-subscriber')->dailyAt('11:59');

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
