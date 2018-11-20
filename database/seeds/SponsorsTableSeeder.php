<?php

use App\Event;
use App\Sponsor;
use Illuminate\Database\Seeder;

class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Sponsor::class, 16)->create();

        foreach(Sponsor::all() as $sponsor){
            $sponsor->events()->attach(Event::find(1));
        }
    }
}
