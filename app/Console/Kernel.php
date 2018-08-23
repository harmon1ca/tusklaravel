<?php

namespace App\Console;

use App\Http\Controllers\TcpController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Proxies;

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
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function () {
            $tcp = new TcpController();
            $status = $tcp->index();

            foreach($status as $key)
            {
//            echo "<br/>".$key['status'];
//            echo "<br/>".$key['id'];
                $update = Proxies::find($key['id']);
                if($key['status'] > 0){
                    $update->availablity = 1;
                    $update->LATENCY = $key['status'];
                }else{
                    $update->availablity = 0;
                }
                $update->save();
            };
//            $tcp->curlRequest();

        })->everyTenMinutes();
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
