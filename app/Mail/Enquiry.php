<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Enquiry extends Mailable
{
    use Queueable, SerializesModels;
    public $name, $email, $phone, $messageContent, $company, $sponsorshipTypes, $enquiryType;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $phone, $message, $company, $sponsorshipTypes, $enquiryType)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->messageContent = $message;
        $this->company = $company;
        $this->sponsorshipTypes = $sponsorshipTypes;
        $this->enquiryType = $enquiryType;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->replyTo($this->email);
        return $this->view('emails.contact.enquiryReceived')
                    ->text('emails.contact.enquiryReceivedPlain')
                    ->subject('New '.ucfirst($this->enquiryType).' Enquiry Received');
    }
}
