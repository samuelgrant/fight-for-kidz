<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Request;

use App\User;
use App\Http\Controllers\admin\UserManagementController;
use Faker\Generator as Faker;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests enable() and disable() functions on the User model
     *
     * @return void
     */
    public function testEnableDisable()
    {       
        // Create a user 
        $testUser = factory(User::class)->create();

        // Check user is in database and defaults to inactive
        $this->assertDatabaseHas('users', [
            'name' => $testUser->name,
            'email' => $testUser->email,
            'active' => 0
        ]);

       // Check the enable function on the user
        $testUser->enable();
        $this->assertDatabaseHas('users', [
            'email' => $testUser->email,
            'active' => 1
        ]);

        // Check the disable function on the user
        $testUser->disable();
        $this->assertDatabaseHas('users', [
            'email' => $testUser->email,
            'active' => 0
        ]);
    }
}
