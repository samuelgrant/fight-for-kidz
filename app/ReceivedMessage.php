<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Contact;

class ReceivedMessage extends Model
{
    use SoftDeletes;

    /**
     *  Returns the contact record for the message sender,
     *  if any. 
     * 
     *  Else returns null.
     */
    public function senderAsContact(){
        return Contact::where('email', $this->email)->first();
    }
}
