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

        Artisan::call('migrate:fresh', ['--seed' => 'default']);
    }

    /**
     * This test confirms that the addToGroup method in
     * the Groupable trait is functioning correctly.
     *
     * @return void
     * @group GroupTests
     * call this test individually with phpunit --group GroupTests
     */
    public function testGroupable()
    {
        // Retrieve some models from the 5 groupable tables
        $subscriber = Subscriber::find(88);
        $sponsor = Sponsor::find(2);
        $user = User::find(1);
        $contact = Contact::find(4);
        $applicant = Applicant::find(39);

        // Retrieve group models
        $group1 = Group::find(1);
        $group2 = Group::find(2);
        $group3 = Group::find(3);

        // Add to a group
        $subscriber->addToGroup(1);
        $sponsor->addToGroup(1);
        $user->addToGroup(1);
        $contact->addToGroup(1);
        $applicant->addToGroup(1);

        // Check that group 1 has 5 members
        $this->assertTrue(count($group1->fresh()->recipients()) == 5);

        // Try adding subscriber to the group again, confirm that recipients count does not increase
        // and that the groupable model reflects this.
        $subscriber->addToGroup(1);
        $this->assertTrue(count($group1->fresh()->recipients()) == 5);
        $this->assertTrue(count($subscriber->groups) == 1);

        // Add subscriber to two other groups, assert that the subscriber has three group memberships
        $subscriber->addToGroup(2);
        $subscriber->addToGroup(3);
        $this->assertTrue(count($subscriber->fresh()->groups) == 3);

        // Remove subscriber from group, check that recipients count goes down.
        $subscriber->removeFromGroup(1);
        $this->assertTrue(count($group1->fresh()->recipients()) == 4);

        // Make a new contact that has the same email address as the subscriber, and assert that 
        // the duplicate address is not included in the recipients() output of the group
        $contact2 = new Contact;
        $contact2->name = 'Test';
        $contact2->email = $subscriber->email;
        $contact2->save();

        $contact2->addToGroup(2);
        $this->assertTrue(count($group2->fresh()->recipients()) == 1); // filtering duplicate 
        $this->assertTrue(count($group2->fresh()->recipients(false)) == 2); // not filtering duplicate
    }
}
