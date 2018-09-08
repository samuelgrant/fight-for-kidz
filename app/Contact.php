<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Groupable;

class Contact extends Model
{

    use Groupable;

    public function groups(){
        return $this->morphToMany('App/Group', 'groupable');
    }
}
