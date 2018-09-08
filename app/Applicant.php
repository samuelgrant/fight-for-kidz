<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Groupable;

class Applicant extends Model
{
    use Groupable;
    
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
    // aka was this applicant accepted.
    
    public function isContender(){
        return $this->contender != null;
    }
}
