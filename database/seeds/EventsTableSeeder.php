<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Event::class)->create([
            'name' => 'Fight For Kidz 2019',
            'venue_name' => 'ILT Stadium',
            'venue_address' => 'Glengarry, Invercargill 9810'
        ]);

        factory(App\Event::class)->create([
            'name' => 'Fight For Kidz 2018',
            'venue_name' => 'Hansen Hall, SIT Invercargill',
            'venue_address' => '133 Tay St, Invercargill, 9810'
        ]);

        factory(App\Event::class)->create([
            'name' => 'Fight For Kidz 2017',
            'venue_name' => 'The Moon',
            'venue_address' => '384,400 km away'
        ]);
    }
}
