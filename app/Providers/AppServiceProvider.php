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
        
        \Blade::if('login', function () {
            if (auth()->check()) {
                return true;
            }
        });

        \Blade::if('notifications', function () {
            if (auth()->user()->notifications->count() > 0) {
                return true;
            }
        });

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
