<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageText;
    public $recipient;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recipient, $subject, $messageText)
    {
        $this->recipient = $recipient;
        $this->messageText = $messageText;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.custom')
                    ->subject($this->subject);
    }
}
