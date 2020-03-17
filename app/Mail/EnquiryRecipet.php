<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnquiryRecipet extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $type)
    {
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact.enquiryRecipet')
                    ->text('emails.contact.enquiryRecipetPlain')
                    ->subject('Fight for Kidz - Thanks for your email');
    }
}
