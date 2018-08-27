<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
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

    // Relationship to team
    // To be implemented
}
