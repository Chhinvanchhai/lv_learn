<?php

namespace App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\DB;
use App\Jobs\MailSend;
use App\Models\User;
 use Spatie\ShortSchedule\ShortSchedule;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public $inc = 1;
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('update:checkstatus')->everyMinute();
    }
    protected function shortSchedule(\Spatie\ShortSchedule\ShortSchedule $shortSchedule)
    {
        // $schedule = new ShortSchedule;
        // this command will run every second
        $shortSchedule->command('update:checkstatus')->everySecond();

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
