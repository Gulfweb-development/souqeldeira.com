<?php

namespace App\Console;

use App\Models\Ad;
use App\Models\Order;
use App\Models\UserMessage;
use App\Notifications\AdminToUserTypeNotification;
use App\Notifications\UserExpireMessageNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Notification;

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
        $schedule->command('queue:work --stop-when-empty')->everyMinute();
        $schedule->call(function(){
            Ad::where('archived_at' , '<' ,  Carbon::now())->delete();
            Log::info('TASK SCUDLAR IS ORKING');
        })->everyMinute();

        $schedule->call(function(){
            $ads = Ad::whereDate('archived_at' ,  Carbon::now()->addDays(config('app.ad_expire_day_notify' , 3)))->get();
            foreach ( $ads as $ad) {
                $userMessage = UserMessage::create([
                    'user_id' => $ad->user_id,
                    'title_en' => trans('app.archived_notify_title' ,['day' => config('app.ad_expire_day_notify' , 3)] , 'en' ),
                    'title_ar' => trans('app.archived_notify_title' ,['day' => config('app.ad_expire_day_notify' , 3)], 'ar' ),
                    'message_en' => trans('app.archived_notify_description' ,['day' => $ad->archived_at , 'advertise' => $ad->title ], 'en' ),
                    'message_ar' => trans('app.archived_notify_description' ,['day' => $ad->archived_at , 'advertise' => $ad->title ], 'ar' ),
                ]);
                Notification::send($ad->user, new UserExpireMessageNotification($userMessage));
            }
        })->daily();

        $schedule->call(function(){
            Order::where('created_at' , '<=' ,  Carbon::now()->subHours(3))
                ->where('status' , 'pending')
                ->update([
                    'status' => 'failed'
                ]);
        })->hourly();
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
