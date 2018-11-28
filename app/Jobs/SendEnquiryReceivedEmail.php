<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnquiryReceived;

class SendEnquiryReceivedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email, $recipient, $type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $recipient, $type)
    {
        $this->email = $email;
        $this->recipient = $recipient;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($email)->send(new EnquiryReceived($this->recipient, $this->type));
    }
}
