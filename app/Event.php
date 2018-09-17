<?php

namespace App;

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
}
