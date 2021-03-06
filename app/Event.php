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

        Event::closePastEventApplications();
        
        Log::debug($this->name.' was added to the public site.');
    }

    /**
     * Show bouts on the public event page
     */
    public function hideBouts(){
        $this->show_bouts = false;
        $this->save();
    }

    /**
     * Show bouts on the public event page
     */
    public function showBouts(){
        $this->show_bouts = true;
        $this->save();
    }

     /**
     * Show bouts on the public event page
     */
    public function hideAuctions(){
        $this->show_auctions = false;
        $this->save();
    }

    /**
     * Show bouts on the public event page
     */
    public function showAuctions(){
        $this->show_auctions = true;
        $this->save();
    }

    /** 
     *  Sets the events applications to either on or off
     * 
     * @return Boolean true if action was successful
     */
    public function setApplications($val){

        if($val == true){

            if($this->isFutureEvent()){
                $this->open = true;
                $this->save();
                return true;
            }else{
                return false;
            }

            
        } else {
            $this->open = false;
            $this->save();
            return true;
        }

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
        return $this->hasMany('App\AuctionItem');
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

    // Relationship to auctions - one to many
    public function auctions()
    {
        return $this->hasMany('App\AuctionItem');
    }

    // Relationship to contender applications - one to many
    public function applicants()
    {
        return $this->hasMany('App\Applicant');
    }

    // Relationship to custom questions
    public function customQuestions(){

        return $this->hasMany('App\CustomQuestion');

    }

    /**
     *  Returns shuffled collection of sponsors.
     *  Allows the sponsors bar to show sponsors in 
     *  different orders so that everyone can be seen.
     */
    public function sponsorsShuffled(){
        return $this->sponsors->shuffle();
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
     * It is passed a new address, and will change the events
     * address to this only if Google Maps returns a valid
     * set of coordinates.
     * 
     * Return value to indicate to the calling method whether
     * it was a success.
     */
    public function updateGPS($address){
        try{
            $response = GoogleMaps::load('geocoding')
            ->setParam (['address' => $address])->get();
            $json = json_decode($response, TRUE);

            Log::debug($response);

            if($json["status"] == "OK"){
                $this->venue_address = $address;
                $this->venue_gps = 'lat: '.$json['results'][0]['geometry']['location']['lat'].", lng: ".$json['results'][0]['geometry']['location']['lng'];
                $this->save(); 
                return 'SUCCESS';
            }else{
                return 'ERROR';
            }


        } catch (Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }      
    }

    /**
     *  Returns collection of contenders for the 
     *  supplied team.
     */
    public function getTeam($team){

        return $this->contenders()->where('team', $team)->get();

    }    

    /**
     *  Turns applications off for events that are not the current event.
     * 
     *  This is called whenever an event is made public.
     */
    public static function closePastEventApplications(){

        $currentEvent = Event::current();

        foreach(Event::all() as $event){
            if($event->open){
                if(!$event->is($currentEvent)){
                    $event->open = false;
                    $event->save();
                }
            }
        }
    }
}
