<?php

namespace App;

use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;
use App\Group;

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
     * @param bool $removeDuplicates Should duplicate addresses be filtered from the returned array?
     * 
     * @return array
     */
    public function recipients($removeDuplicates = true)
    {
        $recipients = [];

        foreach ($this->applicants as $applicant) {
            if ($this->nonUniqueEmail($recipients, $applicant->email && $removeDuplicates)) {
                Log::debug('Duplicate email ' . $applicant->email . ' omitted from array');
            } else {
                $recipients[] = ['role' => 'applicant', 'name' => $applicant->first_name, 'email' => $applicant->email];
            }
        }


        foreach ($this->sponsors as $sponsor) {
            if ($this->nonUniqueEmail($recipients, $sponsor->email) && $removeDuplicates) {
                Log::debug('Duplicate email ' . $sponsor->email . ' omitted from array');
            } else {
                $recipients[] = ['role' => 'sponsor', 'name' => $sponsor->company_name, 'email' => $sponsor->email];
            }
        }


        foreach ($this->users as $user) {
            if ($this->nonUniqueEmail($recipients, $user->email) && $removeDuplicates) {
                Log::debug('Duplicate email ' . $user->email . ' omitted from array');
            } else {
                $recipients[] = ['role' => 'admin', 'name' => $user->name, 'email' => $user->email];
            }
        }


        foreach ($this->contacts as $contact) {
            if ($this->nonUniqueEmail($recipients, $contact->email) && $removeDuplicates) {
                Log::debug('Duplicate email ' . $contact->email . ' omitted from array');
            } else {
                $recipients[] = ['role' => $contact->role, 'name' => $contact->name, 'email' => $contact->email];
            }
        }


        foreach ($this->subscribers as $subscriber) {
            if ($this->nonUniqueEmail($recipients, $subscriber->email) && $removeDuplicates) {
                Log::debug('Duplicate email ' . $subscriber->email . ' omitted from array');
            } else {
                $recipients[] = ['role' => 'subscriber', 'name' => $subscriber->name, 'email' => $subscriber->email];
            }
        }

        return $recipients;
    }

    /**
     * This method checks to see if the provided email address already exists in the 
     * provided array of associative arrays.
     * 
     * @return bool
     */
    protected function nonUniqueEmail($array, $email)
    {
        $uniques = array_unique(array_column($array, 'email'));

        return (in_array($email, $uniques));
    }

    /**
     * Resizes and saves the group Avatar
     * Max Size 100H x 80W
     * 
     * @param image
     * @return void
     */
    public function setImage($image){

        if(isset($image)) {
            $image->storeAs('public/images/groups', $this->id.'.png');
            $this->custom_icon = true;
        } else {
            $this->custom_icon = false;
        }

        $this->save();

        return;
    }
}
