<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use App\Models\User;
class CheckStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:checkstatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */

     protected function scheduleSataus(Schedule $schedule)
     {
         $schedule->call(function () {
             $user = User::all();
             print($user);
         })->everyMinute();
     }

    public function handle()
    {
        sleep(5);
        print('in check status');
        return Command::SUCCESS;
    }
}
