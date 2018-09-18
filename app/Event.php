<?php

namespace App;

use \GoogleMaps as GoogleMaps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    
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

    public function updateGPS($address){
        $response = GoogleMaps::load('geocoding')
        ->setParam (['address' => $address])->get();
        $json = json_decode($response, TRUE);

        return ('lat: '.$json['results'][0]['geometry']['location']['lat'].", lng: ".$json['results'][0]['geometry']['location']['lng']);  
    }
}
