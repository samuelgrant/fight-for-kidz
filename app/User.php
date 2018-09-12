<?php

namespace App;

use App\Traits\Groupable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use Groupable;    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function enable()
    {
        if(!$this->active){
            $this->active = true;
            $this->save();

            
            $this->addToGroup(1);
            //Fire email YOUR ACCOUNT IS NOW ACTIVATED
            //Return WINNING
        }

        //Return account already active error
    }

    public function disable()
    {
        if($this->active){
            $this->active = false;
            $this->save();

            $this->removeFromGroup(1);
            //Remove from admin group (for mailing list things)
            //Fire email account disabled
            
            //Return account now disabled
        }
        //Return already disabled
    }
}
