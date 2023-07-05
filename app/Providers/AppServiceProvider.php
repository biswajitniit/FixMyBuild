<?php

namespace App\Providers;

use App\Models\NotificationDetail;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $unread_notifications = NotificationDetail::where('read_status', 0)->where('user_id', 1)->count();
        $notifications = NotificationDetail::where('user_id', 1)->get();
        // $unread_notifications = NotificationDetail::count_all();
        view()->share('unread_notifications', $unread_notifications);
        view()->share('notifications', $notifications);

    }
}
