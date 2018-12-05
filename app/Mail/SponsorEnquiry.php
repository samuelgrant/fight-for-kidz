<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SponsorEnquiry extends Mailable

{
    use Queueable, SerializesModels;

    public $name, $email, $phone, $type, $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $phone, $type, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.emails.contact.sponsorEnquiry')
                    ->text('view.emails.contact.sponsorEnquiryPlain')
                    ->subject('New Sponsorship Enquiry Received');
    }
}
