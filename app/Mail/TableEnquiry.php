<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TableEnquiry extends Mailable
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
        $this->name = $name;
        $this->email = $email;
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
        return $this->view('view.emails.contact.tableEnquiry')
                    ->text('view.emails.contact.tableEnquiryPlain')
                    ->subject('Table Booking Enquiry Received');
    }
}
