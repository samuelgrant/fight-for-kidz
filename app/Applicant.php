<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    // Relationship to event - many to one
    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    // Relationship to contender - one to one
    public function contender()
    {
        return $this->hasOne('App\Contender');
    }

    public function groups(){
        return $this->belongsToMany('App\Group', 'group_applicant');
    }

    // Return true if a contender record exists for this application
    
    public function isContender(){
        return $this->contender != null;
    }
}
