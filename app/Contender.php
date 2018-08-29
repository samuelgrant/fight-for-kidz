<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contender extends Model
{
    // Relationship to application - one to one
    public function application()
    {
        return $this->belongsTo('App\ContenderApplication');
    }

    // Relationship to event - one to many
    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    // Relationship to sponsor - many to one
    public function sponsor()
    {
        return $this->belongsTo('App\Sponsor');
    }

    // Relationship to bouts - one to many

    // Red bouts
    public function redBouts()
    {
        return $this->hasMany('App\Bout', 'red_contender_id');
    }

    // Blue bouts
    public function blueBouts()
    {
        return $this->hasMany('App\Bout', 'blue_contender_id');
    }

    // Return all bouts
    public function bouts()
    {
        return $this->redBouts->merge($this->blueBouts);
    }

    // Return bouts where contender won
    public function boutsWon()
    {
        return $this->hasMany('App\Bout', 'victor_id');
    }
}
