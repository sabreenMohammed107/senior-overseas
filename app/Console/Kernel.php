<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Operation;
use App\User;
use Carbon\Carbon;
use Notification;
use DateTime;
use Illuminate\Support\Facades\Date;
use App\Notifications\OperationNotification;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\DemoCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
     $operation=null;
      $user=null;
        $schedule->call(function () {
            $operations = Operation::all();
            $user = User::where('role_id', '=', 1)->first();
         
            foreach ($operations as $operation) {
            
               
 
            }
            
         
        })->when(function()use($operation)  {
            $operations = Operation::all();
            $datetime = new DateTime('tomorrow');
            $user = User::where('role_id', '=', 1)->first();

            if(is_null($operations)){
               
                return false;
       
            }
            else{
                foreach ($operations as $operation) {
                if (date_format(date_create($operation->loading_date),'Y-m-d') == $datetime->format('Y-m-d') || date_format(date_create($operation->cut_off_date),'Y-m-d') == $datetime->format('Y-m-d') ||date_format(date_create($operation->arrival_date),'Y-m-d') == $datetime->format('Y-m-d')) {
                    $user->notify(new OperationNotification($operation));

                 }
                }
                return true;
            }
        })->everyMinute();
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
