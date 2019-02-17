<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GeneralEnquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $email, $phone, $messageText;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $phone, $message)
    {
        $this->email = $email;
        $this->name = $name;
        $this->phone = $phone;
        $this->messageText = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->replyTo($this->email);
        return $this->view('emails.contact.generalEnquiry')
                    ->text('emails.contact.generalEnquiryPlain')
                    ->subject('New Enquiry Received');
    }
}
