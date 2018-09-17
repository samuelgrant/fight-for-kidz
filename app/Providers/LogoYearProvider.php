<?php

namespace App\Providers;

use App\Event;
use Illuminate\Support\ServiceProvider;

class LogoYearProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.head', function($view)
        {
            $year = Event::where('is_public', true)::orderBy('datetime')->first();

            $view->with('eventYear', $year); 
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
