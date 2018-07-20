<?php

namespace Tests\Feature;

use Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MailTest extends TestCase
{
    public function setup(){
        parent::setUp();

        $this->from = 'noreply@'.str_replace(' ', '', config('app.name')).'.co.nz';
        $this->to = 'testing@'.str_replace(' ', '', config('app.name')).'.co.nz';
        $this->text = "~~~ Email System Test ~~~\n\nWebsite URL: ".config('app_url')."\nWebsite Env: ".config('app_env');
    }


    /**
     * An example test for phpunit.
     * Test to see if an email can be sent in the dev environment.
     * 
     * @return void
     */
    public function testSendEmail()
    {
        try{
            Mail::raw('test', function ($message){
                $message->to($this->to);
                $message->from($this->from);
                $message->subject('Feature Test Email');
            });
            $error = false;
        } catch (Exception $exception){
            $error = true;
        }
        
        $this->assertFalse($error);
    }
}