<?php

namespace App\Providers;

use App\Event;
use Illuminate\Support\ServiceProvider;

class LogoYearProvider extends ServiceProvider
{
    /**
     * Returns the layouts.head with the date and time of the current event. 
     * 
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.head', function($view)
        {
            $currentEvent = Event::current();

            $view->with('currentEvent', $currentEvent); 
        });
    }
}
