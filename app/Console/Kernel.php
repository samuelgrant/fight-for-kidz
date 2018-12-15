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
        \App\Console\Commands\images\defaults::class,
        \App\Console\Commands\images\purge::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        if(!$this->isProcessRunning('queue:work')){
            $schedule->command('queue:work')->everyMinute();
        }
    }

    /**
     *  Checks if a proces with $needle in the name is running
     *  https://gist.github.com/mauris/11375869
     */
    protected function isProcessRunning($needle){

        // get process status
        exec('ps aux -ww', $process_status);

        // search for $needle
        $result = array_filter($process_status, function($var) use ($needle){
            return strpos($var, $needle);
        });

        // if result is not empty, process exists
        if(!empty($result)){
            return true;
        } else{
            return false;
        }

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
