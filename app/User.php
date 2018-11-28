<?php

namespace App;

use App\Traits\Groupable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use App\Jobs\SendActivatedAccountEmail;
use App\Jobs\SendDeactivatedAccountEmail;
use App\Jobs\SendNewAccountEmail;
use App\Jobs\SendPasswordResetLink;


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
        'name', 'email', 'password', 'password_reset_at',
    ];

    protected $dates = [
        'deleted_at',
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
            
            //Fire email YOUR ACCOUNT IS NOW ACTIVATED
            SendActivatedAccountEmail::dispatch($this);
        }
    }
    
    public function disable()
    {
        if($this->active){
            $this->active = false;
            $this->save();

            // Fire email
            SendDeactivatedAccountEmail::dispatch($this);

        }
    }

    public function sendPasswordResetNotification($token){

        if($this->password_reset_at){
            
            // password reset has been requested by the user
            SendPasswordResetLink::dispatch($this, $token);


            //$this->notify(new ResetPasswordNotification($token));

        } else{
            
            // password reset on initial registration
            SendNewAccountEmail::dispatch($this, $token);
        }

    }
}
