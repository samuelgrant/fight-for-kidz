<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnquiryRecipet;
use Illuminate\Support\Facades\Log;

class SendEnquiryRecipet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $name, $email, $type;    

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, $email, $type)
    {
        $this->name = $name;
        $this->email = $email;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $msg = Mail::to($this->email)->send(new EnquiryRecipet($this->name, $this->type));
        Log::debug('Sending contact received (type ' . $this->type . ') mail to ' . $this->email);
        if($msg){
            Log::debug('Mail job message: ' . $msg);
        }
    }
}
