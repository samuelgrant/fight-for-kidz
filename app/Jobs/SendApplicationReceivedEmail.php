<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationReceived;

class SendApplicationReceivedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email, $recipient;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $recipient)
    {
        $this->email = $email;
        $this->recipient = $recipient;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $msg = Mail::to($this->email)->send(new ApplicationReceived($this->recipient));
        Log::debug('Sending application received mail to ' . $this->email);
        if($msg){
            Log::debug('Mail job message: ' . $msg);
        }
    }
}
