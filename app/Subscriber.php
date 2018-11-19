<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Groupable;

class Subscriber extends Model
{

    use Groupable;

    /**
     * Creates a subscriber record and adds to the 
     * subscribers system group.
     */
    public static function subscribe($name, $email){

        if(!Subscriber::where('email', $email)->count()){
            $subscriber = new Subscriber;
            $subscriber->name = $name;
            $subscriber->email = $email;
            $subscriber->save();

            $subscriber->addToGroup(2);
        }

    }

    /**
     *  Remove subscriber by email
     */
    public static function unsubscribeEmail($email){

        $subscriber = Subscriber::where('email', $email);

        if($subscriber){
            $subscriber->removeFromGroup();
            return true; // subscriber removed
        }

        return false; //subscriber not found

    }

    /**
     *  Removes the subscriber from the subscribers
     *  group. The database record will be maintained.
     */
    public function unsubscribe(){

        $this->removeFromGroup(2);
    }
}   
