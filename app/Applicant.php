<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Groupable;
use Carbon\Carbon;

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

    // Return true if a contender record exists for this application
    // aka was this applicant accepted.
    
    public function isContender(){
        return $this->contender != null;
    }

    public function getAge(){
        $date = Carbon::parse($this->dob);

        return Carbon::now()->diffInYears($date);
    }
}
