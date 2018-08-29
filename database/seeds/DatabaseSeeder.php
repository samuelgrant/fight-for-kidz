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
        // This causes the run() function of UsersTableSeeder to execute -- disable on production
        $this->call(UsersTableSeeder::class);

        // Seeds default user groups, Administrators and Subscribers
        $this->call(DefaultGroupsSeeder::class);
    }
}
