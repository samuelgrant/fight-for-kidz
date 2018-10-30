<?php

use App\Bout;
use App\Contender;
use Illuminate\Database\Seeder;

class BoutsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 5; $i++){

            $bout = new Bout;
            $bout->event_id = 1;
            $bout->red_contender_id = Contender::find($i)->id;
            $bout->blue_contender_id = Contender::find($i + 5)->id;
            $bout->save();
        }
    }
}
