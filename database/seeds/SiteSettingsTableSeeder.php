<?php

use Illuminate\Database\Seeder;
use App\SiteSetting;

class SiteSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // only create if one does not alredy exist. 
        if(count(SiteSetting::all()) < 1){
            factory(App\SiteSetting::class, 1)->create();
        }
    }
}