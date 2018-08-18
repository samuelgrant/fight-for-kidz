<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //Relationship to contenders in the team
    public function contenders()
    {
        return $this->hasMany('App\Contender');
    }
}
