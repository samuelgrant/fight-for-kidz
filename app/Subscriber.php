<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Traits\Groupable;
use App\Jobs\SendSubscribedEmail;

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
            $subscriber->unsubscribe_token = Hash::make($email . uniqid());
            $subscriber->save();

            SendSubscribedEmail::dispatch($subscriber);
        }

    }

    /**
     *  Remove subscriber by email
     */
    public static function unsubscribeEmail($email){

        $subscriber = Subscriber::where('email', $email);

        foreach($subscriber->groups as $group){
            $subscriber->removeFromGroup($group->id);
        }

        if($subscriber){
            $subscriber->delete();
            return true;
        }

        return false; //subscriber not found

    }

    /**
     *  Removes the subscriber from the subscribers
     *  group. The database record will be maintained.
     */
    public function unsubscribe(){

        foreach($this->groups as $group){
            $this->removeFromGroup($group->id);
        }

        $this->delete();
    }
}   
