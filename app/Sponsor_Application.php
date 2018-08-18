<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor_Application extends Model
{
    // Relationship to event - many to one
    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    // Relationship to application - one to one
    // public function sponsor_application()
    // {
    //     return $this->hasOne('App\Sponsor');
    // }
    // Need to think more about this one - can we reuse sponsor records across years?
}
