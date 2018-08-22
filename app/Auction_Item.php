<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction_Item extends Model
{
    // Relationship to event - many to one
    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}
