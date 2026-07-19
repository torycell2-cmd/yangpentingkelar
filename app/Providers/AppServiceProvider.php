<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        View::composer('adminlte::page', function ($view) {
        if (Auth::check()) {
            // Kirim data teman ke navbar
            $view->with('myFriends', Auth::user()->friends);
        }
    });
    }

    
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
