<?php

namespace App\Providers;

use App\Models\notifications;
use Auth;
use Illuminate\Support\ServiceProvider;
use View;

class viewNavbarProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('layouts.layers', function ($view    ){
            $unread = notifications::where('user_id', Auth::user()->user_id)->where('read', 'no')->count();
            $view->with('unread', $unread);
        });
    }
}
