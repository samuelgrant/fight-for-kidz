<?php

namespace App\Mail;

use App\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Subscribed extends Mailable
{
    use Queueable, SerializesModels;

    public $subscriber;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->withSwiftMessage(function ($message){
            $message->getHeaders()->addTextHeader('List-Unsubscribe', '<' . env('APP_URL') . '/unsubscribe?token=' . $this->subscriber->unsubscribe_token . '>');
        });

        return $this->view('emails.subscribers.subscribed')
                    ->subject('Subscribed to Fight for Kidz updates')
                    ->text('emails.subscribers.plaintext.subscribed');
    }
}
