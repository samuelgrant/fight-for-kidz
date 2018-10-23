<?php

namespace App;

use \GoogleMaps as GoogleMaps;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

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

    /**
     *  Returns a datetime string compatible with the
     *  datetime-local input type.
     */
    public function getDateTimeString(){

        $date = Carbon::parse($this->datetime);

        return $date->format('Y-m-d\TH:i:s');

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

    /**
     *  Returns true if event is in the future.
     */
    public function isFutureEvent(){

        $now = new DateTime('nz'); // defaults at current time
        $eventDate = DateTime::createFromFormat('Y-m-d H:i:s', $this->datetime); // convert string from DB into datetime object

        return $eventDate > $now;

    }

    /**
     * This method updates the venue_gps field for the event.
     * It should be called whenever the venue_address field is
     * modified.
     */
    public function updateGPS(){
        $response = GoogleMaps::load('geocoding')
        ->setParam (['address' => $this->venue_address])->get();
        $json = json_decode($response, TRUE);

        $this->venue_gps = 'lat: '.$json['results'][0]['geometry']['location']['lat'].", lng: ".$json['results'][0]['geometry']['location']['lng'];
        $this->save(); 
    }

    /**
     *  Returns collection of contenders for the 
     *  supplied team.
     */
    public function getTeam($team){

        return $this->contenders()->where('team', $team)->get();

    }
}
