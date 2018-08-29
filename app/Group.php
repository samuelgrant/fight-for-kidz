<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    public function applicants(){
        return $this->belongsToMany('App\Applicant', 'group_applicant');
    }

    public function sponsors(){
        return $this->belongsToMany('App\Sponsor', 'group_sponsor');
    }

    public function users(){
        return $this->belongsToMany('App\User', 'group_user');
    }
}
