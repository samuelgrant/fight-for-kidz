<?php

namespace App\Console\Commands;

use App\Event;
use App\SiteSetting;
use Illuminate\Console\Command;

class setupscript extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates the default database entries for the site to function.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if(trim(strtolower(env('APP_ENV'))) == 'production') {
            
            $this->error('You cannot run this setup script if the website environment is production.');
            return;
        }
        
        
        /**
         * Creates the basic site settings required for the application to function.
         */
        $this->info('Creating site settings');
        if(SiteSetting::first() == null) {
            $siteSetting = new SiteSetting();
                $siteSetting->display_merch = false;
                $siteSetting->about_us = "PLEASE LOGIN TO YOUR ADMIN PANEL TO SET THIS PARAGRAPH!";
            $siteSetting->save();

            $this->info('Site settings set!');
        } else {
            $this->warn('Site settings were already set. Skipping.........');
        }

        /**
         * Let's create a basic event. 
         * We will ask the user to input some of the information so they don't have to do it later.
         */
        $this->info('This site requires a basic event to function, let\'s create that now.');
        if(Event::where('is_public', true)->first() != null) {
            $this->warn('We already have at least one public event set. Skipping.........');
        } else {
            $Event = new Event();
                $Event->name = $this->ask('What was the name of your most recent event?');
                $Event->datetime = date('Y-m-d');
                $Event->venue_name = $this->ask('What was the name of the venue?');
                $Event->venue_address = $this->ask('What was the venue address?');
                $Event->is_public = true;
            $Event->save();

            $this->info('Basic event set! You will be able to complete/update this event from your admin panel.');
        }
        
        
        $this->error('Setup complete. PLEASE SET YOUR WEBSITE ENVIRONMENT TO PRODUCTION TO DISABLE THIS SCRIPT!');
    }
}
