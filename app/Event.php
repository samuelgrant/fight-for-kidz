<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    /**
     * Static function returns the current event.
     */
    public static function current(){
        $currentEvent = Event::where('is_public', true)->orderBy('datetime', 'desc')->first();
        return $currentEvent;
    }

    /**
     * Take the event off the public pages
     */
    public function makeNotPublic(){
        $this->is_public = false;
        $this->save();

        Log::debug($this->name.' was taken off the public site.');
    }

    /**
     * Put the event on the public pages
     */
    public function makePublic(){
        $this->is_public = true;
        $this->save();
        
        Log::debug($this->name.' was added to the public site.');
    }
    
    // Relationship to auction items - one to many
    public function auction_items()
    {
        return $this->hasMany('App\Auction_Item');
    }

    // Relationship to sponsor - many to many
    public function sponsors()
    {
        return $this->belongsToMany('App\Sponsor');
    }

    // Relation to contenders - one to many
    public function contenders()
    {
        return $this->hasMany('App\Contender');
    }

    // Relationship to bouts - one to many
    public function bouts()
    {
        return $this->hasMany('App\Bout');
    }

    // Relationship to contender applications - one to many
    public function applicants()
    {
        return $this->hasMany('App\Applicant');
    }
}
