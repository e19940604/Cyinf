<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Cyinf\Services\FacebookService;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
        Commands\AutoRefreshCourse::class,
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
        
        $schedule->call(function(){
            \Log::info("[sendCourseNotification Start]");
            $fs = \App::make(FacebookService::class);
            $count = $fs->sendCourseNotification();
            \Log::info("[sendCourseNotification Send Count] ".$count);
            \Log::info("[sendCourseNotification End]");
        })
        ->everyThirtyMinutes()
        ->when(function () {
            return date('H') >= 7 && date('H') <= 21 && date('i') == 30;
        });
    }
}
