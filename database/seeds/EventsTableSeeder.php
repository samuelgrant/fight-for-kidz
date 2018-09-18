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
            'datetime' => '2019-05-02 13:55:00',
            'venue_name' => 'ILT Stadium',
            'venue_address' => 'ILT Stadium',
            
            'is_public' => '1'
        ]);

        factory(App\Event::class)->create([
            'name' => 'Fight For Kidz 2018',
            'venue_name' => 'Hansen Hall, SIT Invercargill',
            'venue_address' => '133 Tay St Invercargill',
            'datetime' => '2018-12-02 13:55:00',
        ]);

        factory(App\Event::class)->create([
            'name' => 'Fight For Kidz 1969',
            'venue_name' => 'The Moon',
            'venue_address' => '384,400 km away',
            'datetime' => '1969-07-20 13:55:00',
        ]);
    }
}
