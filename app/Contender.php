<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contender extends Model
{
    // Relationship to application - one to one
    public function application()
    {
        return $this->belongsTo('App\Contender_Application');
    }

    // Relationship to event - one to many
    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    // Relationship to team - many to one
    public function team()
    {
        return $this->belongsTo('App\Team');
    }

    // Relationship to sponsor - many to one
    public function sponsor()
    {
        return $this->belongsTo('App\Sponsor');
    }
}
