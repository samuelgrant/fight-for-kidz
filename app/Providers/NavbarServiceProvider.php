<?php

namespace App\Providers;

use App\Event;
use Illuminate\Support\ServiceProvider;

class NavbarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.nav', function($view)
        {
            $events = Event::orderBy('datetime', 'desc')->get();

            $view->with("events", $events); 
        });
    }
}
