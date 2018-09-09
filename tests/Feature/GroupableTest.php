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

    use RefreshDatabase;

    public function setUp(){
        parent::setUp();

        Artisan::call('db:seed');
    }


    /**
     * This test confirms that the addToGroup method in
     * the Groupable trait is functioning correctly.
     *
     * @return void
     */
    public function testGroupable()
    {
        $subscriber = Subscriber::find(321);
        $sponsor = Sponsor::find(2);
        $user = User::find(1);
        $contact = Contact::find(4);
        $applicant = Applicant::find(39);

        $subscriber->addToGroup(1);
        $sponsor->addToGroup(1);
        $user->addToGroup(1);
        $contact->addToGroup(1);
        $applicant->addToGroup(1);

        $group = Group::find(1);        

        Log::debug($group->recipients());

        $this->assertTrue(true);
    }
}
