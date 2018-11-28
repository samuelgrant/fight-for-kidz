<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnquiryReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $recipient, $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recipient, $type)
    {
        $this->recipient = $recipient;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.enquiryReceived')
                    ->subject('Enquiry Received')
                    ->text('emails.enquiryReceivedPlain');
    }
}
