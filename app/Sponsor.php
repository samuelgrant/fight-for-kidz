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
    public function bout()
    {
        return $this->hasMany('App\Bout');
    }

    // Relationship to contenders - one to many
    public function contender()
    {
        return $this->hasMany('App\Contender');
    }

    public function groups(){
        return $this->belongsToMany('App\Group', 'group_sponsor');
    }
}
