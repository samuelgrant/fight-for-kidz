<?php

use Illuminate\Database\Seeder;

class F4K2018Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the event
        factory(App\Event::class)->create([
            'name' => 'Fight for Kidz 2018',
            'venue_name' => 'ILT Stadium Southland, Invercargill',
            'venue_address' => 'ILT Stadium, Invercargill, 9810',
            'venue_gps' => 'lat: -46.406884, lng: 168.381462',
            'datetime' => '2018-04-28 19:00:00',
            'is_public' => '1', // will show on public site
            'open' => '0', // not open for applications
            'ticket_seller_url' => "https://www.ticketdirect.co.nz/event/details/175000/fight-4-kidz-charity-boxing-event"
        ]);

        // Create all applicants
        factory(App\Applicant::class)->create([
            'first_name' => 'Paul',
            'last_name' => 'Robertson',
            'dob' => '1974-01-01',
        ]);        

        factory(App\Applicant::class)->create([
            'first_name' => 'Shannon',
            'last_name' => 'Cox',
            'dob' => '1978-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Alissa',
            'last_name' => 'Sutherland',
            'dob' => '1996-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Kelly',
            'last_name' => 'Russell',
            'dob' => '1994-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Zane',
            'last_name' => 'Langford',
            'dob' => '1979-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Joe',
            'last_name' => 'Blee',
            'dob' => '1975-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Taurs',
            'last_name' => 'Furlonge',
            'dob' => '1982-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Logan',
            'last_name' => 'Valli',
            'dob' => '1979-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Kendall',
            'last_name' => 'McMinn',
            'dob' => '1992-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Megan',
            'last_name' => 'Anderson',
            'dob' => '1990-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Dom',
            'last_name' => 'Rikiti',
            'dob' => '1978-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Brad',
            'last_name' => 'Anderson',
            'dob' => '1981-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Toru',
            'last_name' => 'Uamaki',
            'dob' => '1981-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Casey',
            'last_name' => 'Calder',
            'dob' => '1985-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Bobi-Rose',
            'last_name' => 'Leatherby',
            'dob' => '1987-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Katie',
            'last_name' => 'McDowell',
            'dob' => '1986-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Ete',
            'last_name' => 'Sapini',
            'dob' => '1978-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Hayden',
            'last_name' => 'Roderique',
            'dob' => '1979-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Toni',
            'last_name' => 'Eade',
            'dob' => '1985-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Tracey',
            'last_name' => 'Allen',
            'dob' => '1988-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Haydyn',
            'last_name' => 'Taylor',
            'dob' => '1979-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Mana',
            'last_name' => 'Harrison',
            'dob' => '1981-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Tangaroa',
            'last_name' => 'Walker',
            'dob' => '1990-01-01',
        ]);

        factory(App\Applicant::class)->create([
            'first_name' => 'Tama',
            'last_name' => 'Toomata',
            'dob' => '1986-01-01',
        ]);
    }
}
