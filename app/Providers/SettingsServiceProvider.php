<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\SiteSetting;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // return site settings object with every view
        view()->composer('*', function($view)
        {
            $settings = SiteSetting::all()->first();
            $view->with("settings", $settings); 
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
