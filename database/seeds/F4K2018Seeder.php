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
            'show_bouts' => '1',
            'open' => '0', // not open for applications
            'ticket_seller_url' => "https://www.ticketdirect.co.nz/event/details/175000/fight-4-kidz-charity-boxing-event",
            'charity' => 'Koha Kai',
            'charity_url' => 'https://www.facebook.com/kohakai/',
            'desc_1' => 'We will do all the hard work to bring you a top night of entertainment and excitement while at the same time raising funds for a very worthwhile cause, Koha Kai. BUT, we really need your help to make a difference. Our 24 brave boxers have put their blood sweat and tears in to help this cause. Please support this great event by way of a donation toward this very worthwhile cause. It does not need to be a huge donation, every little bit helps.'
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

        // Create all sponsors

        factory(App\Sponsor::class)->create([
            'company_name' => 'AB Equipment' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Clearways' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Stabicraft' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Russell Cunningham Properties' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Sutherland On-Farm Solutions' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Calypso' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Escape Glass' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Central Southland Freight Winton' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Bragg Building and Design' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'C. Brown Builders' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Exceed Homes' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Fonterra' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Acute Plumbing' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Sheet Metalcraft' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Mac Lovin Dairies' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'McCulloch Partners' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Harcourts' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'GWD Motor Group' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => '295 On Tay Motel' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Pro Storage Invercargill' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'New World Windsor' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Professionals' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Nathan McDermott Building' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Jason Taylor Vehicle Sales' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'JP Plastering' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Port Maintenance Group' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Brand Brick and Blocklaying' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Alhambra Oaks' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Northside Sand and Gravel' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Southland Kia' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Calder Stewart' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Redpaths' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'Yunca' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'The Barracks' 
        ]);

        factory(App\Sponsor::class)->create([
            'company_name' => 'PlaceMakers' 
        ]);

        // Add all sponsors to the event by inserting
        // directly into pivot table.

        DB::table('event_sponsor')->insert([
            ['event_id' => 1, 'sponsor_id' => 1],
            ['event_id' => 1, 'sponsor_id' => 2],
            ['event_id' => 1, 'sponsor_id' => 3],
            ['event_id' => 1, 'sponsor_id' => 4],
            ['event_id' => 1, 'sponsor_id' => 5],
            ['event_id' => 1, 'sponsor_id' => 6],
            ['event_id' => 1, 'sponsor_id' => 7],
            ['event_id' => 1, 'sponsor_id' => 8],
            ['event_id' => 1, 'sponsor_id' => 9],
            ['event_id' => 1, 'sponsor_id' => 10],
            ['event_id' => 1, 'sponsor_id' => 11],
            ['event_id' => 1, 'sponsor_id' => 12],
            ['event_id' => 1, 'sponsor_id' => 13],
            ['event_id' => 1, 'sponsor_id' => 14],
            ['event_id' => 1, 'sponsor_id' => 15],
            ['event_id' => 1, 'sponsor_id' => 16],
            ['event_id' => 1, 'sponsor_id' => 17],
            ['event_id' => 1, 'sponsor_id' => 18],
            ['event_id' => 1, 'sponsor_id' => 19],
            ['event_id' => 1, 'sponsor_id' => 20],
            ['event_id' => 1, 'sponsor_id' => 21],
            ['event_id' => 1, 'sponsor_id' => 22],
            ['event_id' => 1, 'sponsor_id' => 23],
            ['event_id' => 1, 'sponsor_id' => 24],
            ['event_id' => 1, 'sponsor_id' => 25],
            ['event_id' => 1, 'sponsor_id' => 26],
            ['event_id' => 1, 'sponsor_id' => 27],
            ['event_id' => 1, 'sponsor_id' => 28],
            ['event_id' => 1, 'sponsor_id' => 29],
            ['event_id' => 1, 'sponsor_id' => 30],
            ['event_id' => 1, 'sponsor_id' => 31],
            ['event_id' => 1, 'sponsor_id' => 32],
            ['event_id' => 1, 'sponsor_id' => 33],
            ['event_id' => 1, 'sponsor_id' => 34],
            ['event_id' => 1, 'sponsor_id' => 35]
        ]);

        // Create all contenders

        factory(App\Contender::class)->create([
            'first_name' => 'Paul',
            'last_name'  => 'Robertson',
            'team' => 'blue',
            'nickname' => 'The Reaper',
            'weight' => '77',
            'height' => '174',
            'reach' => '174',
            'applicant_id' => '1',
            'sponsor_id' => '2',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Shannon',
            'last_name'  => 'Cox',
            'team' => 'red',
            'nickname' => 'The Super Cannon',
            'weight' => '72',
            'height' => '179',
            'reach' => '187',
            'applicant_id' => '2',
            'sponsor_id' => '3',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Alissa',
            'last_name'  => 'Sutherland',
            'team' => 'blue',
            'nickname' => 'Hotstepper',
            'weight' => '59',
            'height' => '164',
            'reach' => '166',
            'applicant_id' => '3',
            'sponsor_id' => '5',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Kelly',
            'last_name'  => 'Russell',
            'team' => 'red',
            'nickname' => 'The Muscle',
            'weight' => '58',
            'height' => '168',
            'reach' => '164',
            'applicant_id' => '4',
            'sponsor_id' => '6',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Zane',
            'last_name'  => 'Langford',
            'team' => 'blue',
            'nickname' => 'Lethal Threat',
            'weight' => '79',
            'height' => '178',
            'reach' => '178',
            'applicant_id' => '5',
            'sponsor_id' => '8',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Joe',
            'last_name'  => 'Blee',
            'team' => 'red',
            'nickname' => 'The Beast',
            'weight' => '76',
            'height' => '171',
            'reach' => '177',
            'applicant_id' => '6',
            'sponsor_id' => '9',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Taurs',
            'last_name'  => 'Furlonge',
            'team' => 'blue',
            'nickname' => 'The Stoneman',
            'weight' => '90',
            'height' => '177',
            'reach' => '190',
            'applicant_id' => '7',
            'sponsor_id' => '11',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Logan',
            'last_name'  => 'Valli',
            'team' => 'red',
            'nickname' => 'The Intimidator',
            'weight' => '89',
            'height' => '178',
            'reach' => '181',
            'applicant_id' => '8',
            'sponsor_id' => '12',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Kendall',
            'last_name'  => 'McMinn',
            'team' => 'blue',
            'nickname' => 'Give em Hell',
            'weight' => '74',
            'height' => '175',
            'reach' => '175',
            'applicant_id' => '9',
            'sponsor_id' => '14',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Megan',
            'last_name'  => 'Anderson',
            'team' => 'red',
            'nickname' => 'Megatron',
            'weight' => '75',
            'height' => '167',
            'reach' => '169',
            'applicant_id' => '10',
            'sponsor_id' => '15',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Dom',
            'last_name'  => 'Rikiti',
            'team' => 'blue',
            'nickname' => 'Private Pain',
            'weight' => '94',
            'height' => '180',
            'reach' => '174',
            'applicant_id' => '11',
            'sponsor_id' => '17',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Brad',
            'last_name'  => 'Anderson',
            'team' => 'red',
            'nickname' => 'Big Bad',
            'weight' => '108',
            'height' => '187',
            'reach' => '188',
            'applicant_id' => '12',
            'sponsor_id' => '18',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Toru',
            'last_name'  => 'Uamaki',
            'team' => 'blue',
            'nickname' => 'The Silent One',
            'weight' => '88',
            'height' => '171',
            'reach' => '180',
            'applicant_id' => '13',
            'sponsor_id' => '14',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Casey',
            'last_name'  => 'Calder',
            'team' => 'red',
            'nickname' => 'The Brawler',
            'weight' => '92',
            'height' => '177',
            'reach' => '176',
            'applicant_id' => '14',
            'sponsor_id' => '20',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Bobi-Rose',
            'last_name'  => 'Leatherby',
            'team' => 'blue',
            'nickname' => 'The Spitfire',
            'weight' => '56',
            'height' => '160',
            'reach' => '161',
            'applicant_id' => '15',
            'sponsor_id' => '22',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Katie',
            'last_name'  => 'McDowell',
            'team' => 'red',
            'nickname' => 'Unbreakable',
            'weight' => '55',
            'height' => '160',
            'reach' => '154',
            'applicant_id' => '16',
            'sponsor_id' => '23',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Ete',
            'last_name'  => 'Sapini',
            'team' => 'blue',
            'nickname' => 'The Ranger',
            'weight' => '106',
            'height' => '186',
            'reach' => '188',
            'applicant_id' => '17',
            'sponsor_id' => '25',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Hayden',
            'last_name'  => 'Roderique',
            'team' => 'red',
            'nickname' => 'The Hammer',
            'weight' => '110',
            'height' => '180',
            'reach' => '178',
            'applicant_id' => '18',
            'sponsor_id' => '26',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Toni',
            'last_name'  => 'Eade',
            'team' => 'blue',
            'nickname' => 'Twisted Sista',
            'weight' => '84',
            'height' => '168',
            'reach' => '170',
            'applicant_id' => '19',
            'sponsor_id' => '28',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Tracy',
            'last_name'  => 'Allen',
            'team' => 'red',
            'nickname' => 'Short Fuse',
            'weight' => '83',
            'height' => '170',
            'reach' => '172',
            'applicant_id' => '20',
            'sponsor_id' => '29',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Haydyn',
            'last_name'  => 'Taylor',
            'team' => 'blue',
            'nickname' => 'Haymaker',
            'weight' => '81',
            'height' => '180',
            'reach' => '184',
            'applicant_id' => '21',
            'sponsor_id' => '31',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Mana',
            'last_name'  => 'Harrison',
            'team' => 'red',
            'nickname' => 'The Hitman',
            'weight' => '77',
            'height' => '183',
            'reach' => '184',
            'applicant_id' => '22',
            'sponsor_id' => '32',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Tangaroa',
            'last_name'  => 'Walker',
            'team' => 'blue',
            'nickname' => 'Poseidon',
            'weight' => '109',
            'height' => '182',
            'reach' => '189',
            'applicant_id' => '23',
            'sponsor_id' => '34',
        ]);

        factory(App\Contender::class)->create([
            'first_name' => 'Tama',
            'last_name'  => 'Toomata',
            'team' => 'red',
            'nickname' => 'Tongan Tornado',
            'weight' => '101',
            'height' => '187',
            'reach' => '182',
            'applicant_id' => '24',
            'sponsor_id' => '35',
        ]);

        // Create bouts

        factory(App\Bout::class)->create([
            'sponsor_id' => '1',
            'red_contender_id' => '2',
            'blue_contender_id' => '1'
        ]);

        factory(App\Bout::class)->create([
            'sponsor_id' => '4',
            'red_contender_id' => '4',
            'blue_contender_id' => '3'
        ]);

        factory(App\Bout::class)->create([
            'sponsor_id' => '7',
            'red_contender_id' => '6',
            'blue_contender_id' => '5'
        ]);

        factory(App\Bout::class)->create([
            'sponsor_id' => '10',
            'red_contender_id' => '8',
            'blue_contender_id' => '7'
        ]);

        factory(App\Bout::class)->create([
            'sponsor_id' => '13',
            'red_contender_id' => '10',
            'blue_contender_id' => '9'
        ]);

        factory(App\Bout::class)->create([
            'sponsor_id' => '16',
            'red_contender_id' => '12',
            'blue_contender_id' => '11'
        ]);

        factory(App\Bout::class)->create([
            'sponsor_id' => '19',
            'red_contender_id' => '14',
            'blue_contender_id' => '13'
        ]);

        factory(App\Bout::class)->create([
            'sponsor_id' => '21',
            'red_contender_id' => '16',
            'blue_contender_id' => '15'
        ]);

        factory(App\Bout::class)->create([
            'sponsor_id' => '24',
            'red_contender_id' => '18',
            'blue_contender_id' => '17'
        ]);

        factory(App\Bout::class)->create([
            'sponsor_id' => '27',
            'red_contender_id' => '20',
            'blue_contender_id' => '19'
        ]);

        factory(App\Bout::class)->create([
            'sponsor_id' => '30',
            'red_contender_id' => '22',
            'blue_contender_id' => '21'
        ]);

        factory(App\Bout::class)->create([
            'sponsor_id' => '33',
            'red_contender_id' => '24',
            'blue_contender_id' => '23'
        ]);
    }
}
