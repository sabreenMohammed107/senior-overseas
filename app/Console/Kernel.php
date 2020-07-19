<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Operation;
use App\User;
use Carbon\Carbon;
use Notification;
use App\Notifications\OperationNotification;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // \App\Console\Commands\DemoCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
     
      
        $schedule->call(function () {
            $operations = Operation::all();
            $user = User::where('role_id', '=', 1)->first();
            foreach ($operations as $operation) {
                // if (Carbon::yesterday() == $operation->loadind_date) {
                  
                    $user->notify(new OperationNotification($operation));
                // }
            }
            //  $user->notify(new OperationNotification());
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
