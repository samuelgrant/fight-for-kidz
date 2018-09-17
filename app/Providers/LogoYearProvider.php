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
            $year = Event::where('is_public', true)->orderBy('datetime')->first()->datetime;

            $view->with('eventYear', $year); 
        });
    }
}
