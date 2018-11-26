<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Html2Text;

class CustomMail extends Mailable
{
    use Queueable, SerializesModels;

    public $attachmentDetails;
    public $plainMessage;
    public $messageText;
    public $recipient;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recipient, $subject, $messageText, $attachmentDetails)
    {
        $this->recipient = $recipient;
        $this->messageText = $messageText;
        $this->subject = $subject;
        $this->attachmentDetails = $attachmentDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->view('emails.custom')->subject($this->subject);

        // attach attachments to the email
        foreach($this->attachmentDetails as $file){
            $email->attach($file['storedPath'], [ 
                'as' => $file['filename'],
                'mime' => $file['fileMime'],
            ]);
        }

        // plain text version of email to reduce spam index
        $html2text = new Html2Text($this->messageText);
        $this->plainMessage = $html2text->getText();
        $email->text('emails.customPlain');

        return $this;
    }
}
