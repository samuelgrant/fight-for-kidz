<?php

namespace Tests\Feature;

use Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MailTest extends TestCase
{
    
    /**
     * A basic test example.
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
