<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SponsorEnquiry extends Mailable

{
    use Queueable, SerializesModels;

    public $name, $companyName, $email, $phone, $type, $messageText;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $companyName, $email, $phone, $type, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->type = $type;
        $this->messageText = $message;
        $this->companyName = $companyName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->replyTo($this->email);
        return $this->view('emails.contact.sponsorEnquiry')
                    ->text('emails.contact.sponsorEnquiryPlain')
                    ->subject('New Sponsorship Enquiry Received');
    }
}
