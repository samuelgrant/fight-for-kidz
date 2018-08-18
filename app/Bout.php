<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bout extends Model
{
    // Relationship to event - many to one
    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    // Relationship to sponsor - many to one
    public function sponsor()
    {
        return $this->belongsTo('App\Sponsor');
    }

    // Relationship to blue contender -
    public function blue_contender()
    {
        return $this->belongsTo('App\Contender', 'blue_contender_id');
    } 

    // Relationship to red contender -
    public function red_contender(){
        return $this->belongsTo('App\Contender', 'red_contender_id');
    }

    // Relationship to victor - 
    public function victor()
    {
        return $this->belongsTo('App\Contender', 'victor_id');
    }
}
