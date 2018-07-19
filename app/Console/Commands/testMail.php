<?php

namespace App\Console\Commands;

use Mail;
use Illuminate\Console\Command;

class testMail extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'mail:test';

    /**
     * The console command description.
     */
    protected $description = 'Sends a test email';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
        $this->from = 'noreply@'.str_replace(' ', '', config('app.name')).'.co.nz';
        $this->to = 'testing@'.str_replace(' ', '', config('app.name')).'.com';
    }

    /**
     * Sends a test mail
     */
    public function handle()
    {
        $text = "~~~ EMAIL SYSTEM TEST ~~~\n\n\nWebsite: ".config('app.url')."\nWebsite Env: ".config('app.env')."\n\nIf you see this, it works!";
        try 
        {
            Mail::raw($text, function ($message){
                $message->to(strtolower($this->to));
                $message->from(strtolower($this->from));
                $message->subject('Development Testing Email');
            });

            $this->comment('This message indicates that there were no errors.');
        } 
        catch(Exception $e)
        {
            unset($e);
        }
    }
}
