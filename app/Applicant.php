<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Contender;
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

    /**
     * Returns true if the applicant has an associated
     * contender record and the contender is assigned to 
     * a team.
     */
    
    public function isContender(){

        if($this->contender != null){
            return $this->contender->team != null;
        }

        return false;
    }

    /**
     *  Creates a contender record for this applicant.
     */
    public function addToTeam($team){

        // check whether a contender already exists
        if($this->contender == null){

            $contender = new Contender;
            $contender->applicant_id = $this->id;
            $contender->weight = $this->expected_weight;
            $contender->height = $this->height;
            $contender->nickname = $this->preferred_nickname;
            $contender->team = $team;
            $contender->save();

            // set foreign key field on contender
            $this->contender()->associate($contender);

        }
        else { //contender record already exists, change team only

            $contender = $this->contender;
            $contender->team = $team;
            $contender->save();
        }

    }

    /**
     *  Returns the age of the applicant
     */

    public function getAge(){
        $date = Carbon::parse($this->dob);

        return Carbon::now()->diffInYears($date);
    }
}
