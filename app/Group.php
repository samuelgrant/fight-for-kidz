<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    public function applicants()
    {
        return $this->morphedByMany('App\Applicant', 'groupable');
    }

    public function sponsors()
    {
        return $this->morphedByMany('App\Sponsor', 'groupable');
    }

    public function users()
    {
        return $this->morphedByMany('App\User', 'groupable');
    }

    public function contacts()
    {
        return $this->morphedByMany('App\Contact', 'groupable');
    }

    public function subscribers()
    {
        return $this->morphedByMany('App\Subscriber', 'groupable');
    }

    /**
     *  Returns an array of associative arrays, each one containing the role, name and email of 
     *  mail group member.
     * 
     *  The role equals the name of the table (i.e. sponsor, applicant), except for members of the
     *  user table, whose role is 'admin', and members of the contacts table, whose role is defined
     *  within the 'role' field of that table.
     * 
     * @return array
     */
    public function recipients()
    {
        $recipients = [];

        $applicants = $this->applicants;
        $sponsors = $this->sponsors;
        $users = $this->users;
        $contacts = $this->contacts;
        $subscribers = $this->subscribers;

        foreach ($applicants as $applicant) {
            $recipients[] = ['role' => 'applicant', 'name' => $applicant->first_name, 'email' => $applicant->email];
        }


        foreach ($sponsors as $sponsor) {
            $recipients[] = ['role' => 'sponsor', 'name' => $sponsor->company_name, 'email' => $sponsor->email];
        }


        foreach ($users as $user) {
            $recipients[] = ['role' => 'admin', 'name' => $user->name, 'email' => $user->email];
        }


        foreach ($contacts as $contact) {
            $recipients[] = ['role' => $contact->role, 'name' => $contact->name, 'email' => $contact->email];
        }


        foreach ($subscribers as $subscriber) {
            $recipients[] = ['role' => 'subscriber', 'name' => $subscriber->name, 'email' => $subscriber->email];
        }
        

        /* 
         * Remove duplicates if present - needs to be coded.
         */


        return $recipients;
    }
}
