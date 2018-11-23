<?php

namespace App;

use App\Traits\Groupable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\InitialResetPasswordNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use App\Mail\AccountActivated;
use App\Mail\AccountDeactivated;


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
            Mail::to($this->email)->send(new AccountActivated($this));
        }
    }
    
    public function disable()
    {
        if($this->active){
            $this->active = false;
            $this->save();

            // Fire email
            Mail::to($this->email)->send(new AccountDeactivated($this));

        }
    }

    public function sendPasswordResetNotification($token){

        if($this->password_reset_at){
            
            // password reset has been requested by the user
            $this->notify(new ResetPasswordNotification($token));

        } else{
            
            // password reset on initial registration
            $this->notify(new InitialResetPasswordNotification($token));
        }

    }
}
