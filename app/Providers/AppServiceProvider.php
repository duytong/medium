<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);
        
        // Check login.
        \Blade::if('login', function () {
            if (auth()->check()) {
                return true;
            }
        });

        // Count notifications.
        \Blade::if('notifications', function () {
            if (auth()->user()->notifications->count() > 0) {
                return true;
            }
        });

        // Count notifications unred.
        \Blade::if('unreadNotifications', function () {
            if (auth()->user()->unreadNotifications->count() > 0) {
                return true;
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
