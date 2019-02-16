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
        $id = 1;

        foreach(Sponsor::all() as $sponsor){
            
            $sponsor->events()->attach(Event::find($id++));

            if($id == 4){
                $id = 1;
            }
        }
    }
}
