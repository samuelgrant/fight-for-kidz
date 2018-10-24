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
            'name' => 'Fight for Kidz 2019',
            'venue_name' => 'ILT Stadium',
            'venue_address' => 'Glengarry, Invercargill 9810',
            'venue_gps' => 'lat: -46.4037442, lng: 168.3789479',
            'datetime' => '2019-05-02 13:55:00',
            'is_public' => '1'
        ]);

        factory(App\Event::class)->create([
            'name' => 'Fight for Kidz 2018',
            'venue_name' => 'Hansen Hall, SIT Invercargill',
            'venue_address' => '133 Tay St, Invercargill, 9810',
            'venue_gps' => 'lat: -46.4037442, lng: 168.3789479',
            'datetime' => '2018-12-02 13:55:00',
        ]);

        factory(App\Event::class)->create([
            'name' => 'Fight for Kidz 1969',
            'venue_name' => 'The Moon',
            'venue_address' => '384,400 km away',
            'venue_gps' => 'lat: -46.4037442, lng: 168.3789479',
            'datetime' => '1969-07-20 13:55:00',
        ]);
    }
}
