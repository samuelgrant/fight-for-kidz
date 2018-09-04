<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;  
  
    public function applicants(){
        return $this->belongsToMany('App\Applicant', 'group_applicant');
    }

    public function sponsors(){
        return $this->belongsToMany('App\Sponsor', 'group_sponsor');
    }

    public function users(){
        return $this->belongsToMany('App\User', 'group_user');
    }

    /**
     *  Returns an array of associative arrays, each one containing the role, name and email of 
     *  mail group member.
     * 
     * @return array
     */
    public function contacts(){
        $applicants = $this->applicants();
        $sponsors = $this->sponsors();
        $users = $this->users();

        foreach($applicants as $applicant){
            $contacts[] = ['role' => 'applicant', 'name' => $applicant->name, 'email' => $applicant->email];
        }

        foreach($sponsors as $sponsor){
            $contacts[] = ['role' => 'sponsor', 'name' => $sponsor->name, 'email' => $sponsor->email];
        }

        foreach($users as $user){
            $contacts[] = ['role' => 'user', 'name' => $user->name, 'email' => $user->email];
        }

        return $contacts;
    }
}
