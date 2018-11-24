<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * 
     */
    public function run()
    {
        

        factory(App\Event::class)->create([
            'name' => 'Fight for Kidz 2018',
            'venue_name' => 'Hansen Hall, SIT Invercargill',
            'venue_address' => '133 Tay St, Invercargill, 9810',
            'venue_gps' => 'lat: -46.4037442, lng: 168.3789479',
            'datetime' => '2018-12-12 13:55:00',
            'is_public' => '1',
            'open' => '1',
            'ticket_seller_url' => "https://www.ticketdirect.co.nz"
        ]);

        factory(App\Event::class)->create([
            'name' => 'Fight for Kidz 2017',
            'venue_name' => 'ILT Stadium',
            'venue_address' => 'ILT Stadium, Invercargill',
            'venue_gps' => 'lat: -46.4066806, lng: 168.380873',
            'datetime' => '2017-07-20 13:55:00',
            'is_public' => '1',
            'ticket_seller_url' => "https://www.ticketdirect.co.nz"
        ]);

        factory(App\Event::class)->create([
            'name' => 'Fight for Kidz 2022',
            'venue_name' => 'ILT Stadium',
            'venue_address' => 'ILT Stadium, Invercargill',
            'venue_gps' => 'lat: -46.4066806, lng: 168.380873',
            'datetime' => '2019-07-20 13:55:00',
            'is_public' => '1',
            'ticket_seller_url' => "https://www.ticketdirect.co.nz"
        ]);
    }
}
