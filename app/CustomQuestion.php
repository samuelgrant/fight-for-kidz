<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomQuestion extends Model
{
    public function event(){

        return $this->belongsTo('App\Event');
    }
}
