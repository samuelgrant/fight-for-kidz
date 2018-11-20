<?php

use App\User;
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
        //Create Two Users
        $userOne = new User();
            $userOne->name = 'Admin';
            $userOne->email = 'admin@example.com';
            $userOne->password = '$2y$10$6z.fpsPw33atdIbj6mwhKevVR.lYRKrjxNxBBtS4XPmun9r4yOkzi';
            $userOne->password_reset_at = Carbon\Carbon::now();
        $userOne->save();

        $userTwo = new User();
            $userTwo->name = 'Test User';
            $userTwo->email = 'test@example.com';
            $userTwo->password = '$2y$10$6z.fpsPw33atdIbj6mwhKevVR.lYRKrjxNxBBtS4XPmun9r4yOkzi';
            $userTwo->password_reset_at = Carbon\Carbon::now();
        $userTwo->save();

        //Set User One to Admin
        $userOne->enable();

        Log::debug('Test user accounts created');
    }
}
