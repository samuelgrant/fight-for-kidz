<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contender_Application extends Model
{
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

    // Relationship to application notes
    // Table yet to be created
}
