<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Request;

use App\User;
use App\Http\Controllers\admin\UserManagementController;
use Faker\Generator as Faker;

class UserManagementTest extends TestCase
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

    /**
     * Tests that the destroy() function is soft deleting the correct user.
     * 
     * @return void
     */
    public function testDestroy()
    {

        //Create logged in user and other user.

         $authenticatedUser = factory(User::class)->create([
             'active' => 1
         ]);
         $otherUser = factory(User::class)->create();
                        
        /*
        * Simulates someone trying to delete themselves. Should not soft delete.
        */
        $this->actingAs($authenticatedUser)->delete('UserManagementController@destroy', ['userID' => $authenticatedUser->id]);
        $this->assertDatabaseHas('users', [
            'id' => $authenticatedUser->id,
            'deleted_at' => null // i.e. not deleted
        ]);

        /*
        * Simulates someone trying to delete another user. Other user should be soft deleted.
        */
        $this->actingAs($authenticatedUser)->delete('UserManagementController@destroy', ['userID' => $otherUser->id]);
        $this->assertSoftDeleted('users', [
            'name' => $otherUser->name,
            'email' => $otherUser->email,
            'id' => $otherUser->id
        ]);

        
    }
}
