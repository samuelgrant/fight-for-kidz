<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TableEnquiry extends Mailable
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
        $this->name = $name;
        $this->email = $email;
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
        return $this->view('emails.contact.tableEnquiry')
                    ->text('emails.contact.tableEnquiryPlain')
                    ->subject('Table Booking Enquiry Received');
    }
}
