<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * This class creates two users for testing purposes.
     * 
     * Use the command 'php artisan db:seed' to execute this seeded along with any others. 
     * Or use 'php artisan db:seed class=UsersTableSeeder' to execute this seeder only.
     *
     * @return void
     */
    public function run()
    {
        
        factory(App\User::class)->create(
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => '$2y$10$6z.fpsPw33atdIbj6mwhKevVR.lYRKrjxNxBBtS4XPmun9r4yOkzi',
                'active' => 1
            ]
        );

        factory(App\User::class)->create(
            [
                'name' => 'Tester',
                'email' => 'tester@example.com',
                'password' => '$2y$10$6z.fpsPw33atdIbj6mwhKevVR.lYRKrjxNxBBtS4XPmun9r4yOkzi',
                'active' => 0
            ]
        );
    }
}
