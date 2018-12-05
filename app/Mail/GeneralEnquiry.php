<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GeneralEnquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $email, $phone, $message;

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
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.emails.contact.generalEnquiry')
                    ->text('view.emails.contact.generalEnquiryPlain')
                    ->subject('New Enquiry Received');
    }
}
