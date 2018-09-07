<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    public function groups(){
        return $this->belongsToMany('App\Group', 'group_subscriber');
    }
}
