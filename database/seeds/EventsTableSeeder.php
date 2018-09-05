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
            'venue_address' => '123 Default Street, Invercargill'
        ]);
    }
}
