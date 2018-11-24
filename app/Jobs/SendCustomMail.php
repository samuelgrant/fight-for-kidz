<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomMail;

class SendCustomMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $messageText;
    protected $recipient;
    protected $subject;
    protected $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $recipient, $subject, $messageText)
    {
        $this->email = $email;
        $this->recipient = $recipient;
        $this->messageText = $messageText;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new CustomMail($this->recipient, $this->subject, $this->messageText));
    }
}
