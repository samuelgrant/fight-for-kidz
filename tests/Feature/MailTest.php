<?php

namespace Tests\Feature;

use Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MailTest extends TestCase
{
    
    /**
     * An example test for phpunit.
     * Test to see if an email can be sent in the dev environment.
     * 
     * @return void
     */
    public function testSendEmail()
    {
        try{
            Mail::raw('Text', function ($message){
                $message->to('contact@contact.com');
            });
            $error = false;
        } catch (Exception $exception){
            $error = true;
        }
        
        $this->assertFalse($error);
    }
}