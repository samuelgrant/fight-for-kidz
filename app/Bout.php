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

    // Relationship to blue contender - many to one
    public function blue_contender()
    {
        return $this->belongsTo('App\Contender');
    } 

    // Relationship to red contender - many to one
    public function red_contender(){
        return $this->belongsTo('App\Contender');
    }

    //Input not implemented at this stage
    // Relationship to victor - many to one
    // public function victor()
    // {
    //     return $this->belongsTo('App\Contender');
    // }

    /**
     * Returns true if bout has both red and blue
     * contenders set.
     */
    public function contendersSet(){

        return isset($this->red_contender, $this->blue_contender);

    }
}
