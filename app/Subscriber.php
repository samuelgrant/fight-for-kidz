<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Groupable;

class Subscriber extends Model
{

    use Groupable;

    public static function subscribe($name, $email){

        if(!Subscriber::where('email', $email)->count()){
            $subscriber = new Subscriber;
            $subscriber->name = $name;
            $subscriber->email = $email;
            $subscriber->save();

            $subscriber->addToGroup(2);
        }

    }
}
