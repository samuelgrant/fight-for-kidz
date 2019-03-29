<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomMail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SendCustomMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $attachmentDetails;
    protected $messageText;
    protected $recipient;
    protected $subject;
    protected $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $recipient, $subject, $messageText, $attachmentDetails)
    {
        $this->email = $email;
        $this->recipient = $recipient;
        $this->messageText = $messageText;
        $this->subject = $subject;
        $this->attachmentDetails = $attachmentDetails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $msg = Mail::to($this->email)->send(new CustomMail($this->email, $this->recipient, $this->subject, $this->messageText, $this->attachmentDetails));
        Log::debug('Sending custom mail (subject: '. $this->subject . ') to ' . $this->email);
        if($msg){
            Log::debug('Mail job message: ' . $msg);
        }
    }
}
