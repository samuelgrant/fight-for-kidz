<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Creates fake user records as defined in /database/factories/UserFactory.php
     *
     * @return void
     */
    public function run()
    {
        
        factory(App\User::class, 50)->create();
    }
}
