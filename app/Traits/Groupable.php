<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use App\Group, App\User, App\Subscriber, App\Sponsor, App\Contact, App\Applicant;

/**
 * This trait should be used by all classes that are to 
 * be added to groups.
 * 
 * The group-member relationship will also need to be configured
 * in the group model and member model.
 */

trait Groupable
{
    public function addToGroup($groupId)
    {
        
    // if not already in group, add to group

    $this->groups()->attach($groupId);

    Log::debug('Added '.get_class($this).' '.$this->id. ' to group '.$groupId);

    }

    public function removeFromGroup($groupId)
    {

    // if in group, remove from group

    $this->groups()->detach($groupId);

    Log::debug('Removed '.get_class($this).' '.$this->id.' from group '.$groupId);

    }

    public function groups(){
        return $this->morphToMany('App\Group', 'groupable');
    }
}

?>