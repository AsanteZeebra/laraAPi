<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Password;



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


   Schema::defaultStringLength(191);


//   Password::createUrlUsing(function ($notifiable, $token) {
//         $frontendUrl = 'http://localhost:3000/Reset-password';
//         return $frontendUrl . '?token=' . $token . '&email=' . urlencode($notifiable->email);
//     });




    }
}
