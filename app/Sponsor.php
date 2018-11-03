<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Groupable;

class Sponsor extends Model
{

    use Groupable;

    // Relationship to event - many to many
    public function events()
    {
        return $this->belongsToMany('App\Event');
    }

    // Relationship to bouts - one to many
    public function bouts()
    {
        return $this->hasMany('App\Bout');
    }

    // Relationship to contenders - one to many
    public function contenders()
    {
        return $this->hasMany('App\Contender');
    }

    public function addToEvent($event){

        $this->events()->attach($event);

    }

    public function removeFromEvent($event){

        $this->events()->detach($event);

    }

    public function setImage($image){

        if($image){
            $image->storeAs('public/images/sponsors', $this->id . '.png');
        }
    }

    /**
     * Returns collection of bouts that this sponsor sponsored, that
     * belong to the given event.
     */
    public function boutsForEvent($eventID){

        return $this->bouts()->where('event_id', $eventID)->get();
    }

    /**
     * Returns array of contenders this sponsor sponsored, that
     * belong to the given event.
     */
    public function contendersForEvent($eventID){
        
        $result = [];

        foreach($this->contenders as $contender){
            if($contender->applicant->event_id == $evendID){
                $result[] = $contender;
            }
        }

        return $result;
    }
}
