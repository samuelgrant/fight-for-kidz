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
    /**
     *  Adds the groupable object to a group based off of the groups ID.
     * 
     *  Tries adding the groupable to the group, if the database throws an exception
     *  becuase the record already exists, then catch the exception and return null.
     * 
     * @return void
     */
    public function addToGroup($groupId)
    {

        try {
            $this->groups()->attach($groupId);

            Log::debug('Added ' . get_class($this) . ' ' . $this->id . ' to group ' . $groupId);

        } catch (\PDOException $ex) {
            
            // code 23000 is an constraint / integrity violation
            if($ex->getCode() == 23000){
                Log::debug(get_class($this).' '.$this->id. ' is already in group '.$groupId);
                return;
            }
            else { // continue to throw the exception if it isn't related to duplicate record.
                throw $ex;
            }
        }
    }

    /**
     *  Removes the groupable from a group based off of the groups ID. 
     * 
     * @return void
     */
    public function removeFromGroup($groupId)
    {
        $this->groups()->detach($groupId);

        Log::debug('Removed ' . get_class($this) . ' ' . $this->id . ' from group ' . $groupId);

    }

    /**
     * Returns an Eloquent collection of the group objects to which this groupable
     * is a member.
     * 
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function groups()
    {
        return $this->morphToMany('App\Group', 'groupable');
    }
}

?>