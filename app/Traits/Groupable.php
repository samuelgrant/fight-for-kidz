<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use App\Group, App\User, App\Subscriber, App\Sponsor, App\Contact, App\Applicant;

/**
 * This trait should be used by all classes that are to 
 * be added to groups.
 */

trait Groupable
{
    public function addToGroup($groupId)
    {
        
    // if not already in group, add to group
    Log::debug('Added '.get_class($this).' '.$this->id. ' to group '.$groupId);

    }

    public function removeFromGroup($groupId)
    {

    // if in group, remove from group
    Log::debug('Removed '.get_class($this).' '.$this->id.' from group '.$groupId);

    }
}

?>