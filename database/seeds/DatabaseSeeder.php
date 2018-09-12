<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database. 
     * 
     * This function is called when the artisan command 'db:seed' is executed.
     * 
     * Individual seeder classes can be run separately by executing the artisan command
     * 'db:seed --class=<seeder class name>'
     *
     * @return void
     */
    public function run()
    {       

        // Seeds default user groups, Administrators and Subscribers
        // This has two happen first otherwise
        $this->call(DefaultGroupsSeeder::class);

        if (!env('app.env') == "production") {

            // Generate two sample users. See wiki for credentials
            $this->call(UsersTableSeeder::class);

            // Generate two test groups
            $this->call(GroupsTableSeeder::class);

            // Fake record seeders
            $this->call(ContactsTableSeeder::class);
            $this->call(SubscribersTableSeeder::class);
            $this->call(SponsorsTableSeeder::class);
            $this->call(EventsTableSeeder::class);
            $this->call(ApplicantsTableSeeder::class);
            $this->call(AuctionItemsTableSeeder::class);
        }
    }
}