<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use App\Subscriber, App\Sponsor, App\User, App\Contact, App\Applicant, App\Group;
use Illuminate\Support\Facades\Log;

class GroupableTest extends TestCase
{

    protected function setUp()
    {
        parent::setUp();

        // Freshly built and seeded database for each test method.
        Artisan::call('migrate:fresh', ['--seed' => 'default']);
    }

    /**
     * This test ensures that admins are not added to the admins
     * group until they have been activated, and that they are 
     * removed from the group when deactivated.
     * 
     * Note: When calling recipients(), duplicate addresses are
     * filtered out of the returned array. When recipients(false)
     * is called, duplicates are left in. This is used for testing.
     */
    public function testAdmins()
    {
        // Admins group should start with the 1 user that was 
        // activated in the seeder class.
        $this->assertTrue(count(Group::find(1)->recipients()) == 1);

        // Activate second user and check they have been added
        // to group.
        User::find(2)->enable();
        $this->assertTrue(count(Group::find(1)->recipients()) == 2);

        // Deactivate an admin and check that the group count drops
        // by one.
        User::find(1)->disable();
        $this->assertTrue(count(Group::find(1)->recipients()) == 1);
    }

    /**
     * This test checks that subscribers are automatically added to
     * the subscribers group upon creation.
     */
    public function testSubscribers()
    {
        // Initial count should be 500 as 500 subscribers are seeded.
        $this->assertTrue(count(Group::find(2)->recipients()) == 500);

        // Delete a subscriber object and check count goes down.
        Subscriber::find(234)->delete();
        $this->assertTrue(count(Group::find(2)->recipients()) == 499);
    }

    /**
     *  This test checks the functionality of the add/remove methods
     *  in the groupables trait.
     */
    public function testGroupables()
    {
        $customGroup = Group::find(3);
        $applicant = Applicant::find(32);
        $user = User::find(2);

        // Group should start empty
        $this->assertTrue(count($customGroup->fresh()->recipients()) == 0); // recipients output
        $this->assertTrue(count($customGroup->fresh()->recipients(false)) == 0); // actual group membership, including different groupables with same email address.

        // Add a member to the group and check that count goes up.
        $applicant->addToGroup(3);
        $this->assertTrue(count($customGroup->fresh()->recipients()) == 1);
        $this->assertTrue(count($customGroup->fresh()->recipients(false)) == 1);

        // Add same member to the same group and check that group stays the same
        $applicant->addToGroup(3);
        $this->assertTrue(count($customGroup->fresh()->recipients(false)) == 1);

        // Add different type of groupable with the same email and check that the 
        // filtering duplicates feature is working.
        $user->email = $applicant->email;
        $user->save();
        $user->addToGroup(3);
        $this->assertTrue(count($customGroup->fresh()->recipients()) == 1); // should filter out duplicate email
        $this->assertTrue(count($customGroup->fresh()->recipients(false)) == 2); // should not filter out duplicate email
    }

    /**
     *  This test test the 'removeMemberByEmail' function
     * @group tester
     */
    public function testRemoveByEmail()
    {
        $group = Group::find(3);

        // Set up five groupables all with the same email address
        $applicant = Applicant::find(1);
        
        $sponsor = Sponsor::find(2);
        $sponsor->email = $applicant->email;
        $sponsor->save();       
        
        $user = User::find(1);
        $user->email = $applicant->email;
        $user->save();
        
        $subscriber = Subscriber::find(123);
        $subscriber->email = $applicant->email;
        $subscriber->save();
        
        $contact = new Contact;
        $contact->name = 'Charlie';
        $contact->email = $applicant->email;
        $contact->save();

        // Add all five groupables to a group
        $applicant->addToGroup(3);
        $sponsor->addToGroup(3);
        $user->addToGroup(3);
        $subscriber->addToGroup(3);
        $contact->addToGroup(3);        
        
        // Check for 1 unique recipient, 5 non unique.
        $this->assertTrue(count($group->fresh()->recipients(false)) == 5);
        $this->assertTrue(count($group->fresh()->recipients()) == 1);
        
        // Add some other groupables
        Applicant::find(10)->addToGroup(3);
        Sponsor::find(10)->addToGroup(3);
        User::find(2)->addToGroup(3);
        Subscriber::find(20)->addToGroup(3);
        $contact2 = new Contact;
        $contact2->name = 'Bob';
        $contact2->email = '123@123.com';
        $contact2->save();
        $contact2->addToGroup(3);

        // Check for ten members, 6 unique addresses.        
        $this->assertTrue(count($group->fresh()->recipients(false)) == 10);
        $this->assertTrue(count($group->fresh()->recipients()) == 6);

        // Remove by email and check that there are 5 members left in group
        $group->removeMembersByEmail($applicant->email);
        $this->assertTrue(count($group->fresh()->recipients()) == 5);
        $this->assertTrue(count($group->fresh()->recipients(false)) == 5);
    }
}
