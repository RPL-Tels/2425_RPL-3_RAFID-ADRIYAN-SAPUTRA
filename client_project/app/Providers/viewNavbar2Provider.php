<?php

namespace App\Providers;

use App\Models\notifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use View;

class viewNavbar2Provider extends ServiceProvider
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
        View::composer('layouts.ChatLayers', function ($view    ){
            $unread = notifications::where('user_id', Auth::user()->user_id)->where('read', 'no')->count();
            $view->with('unread', $unread);
        });
    }
}
