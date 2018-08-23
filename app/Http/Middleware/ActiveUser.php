<?php

namespace App\Http\Middleware;

use Auth;
use App\User;
use Closure;

class ActiveUser
{
    /**
     * Redirects guests to login.
     * Checks that a users account is active
     * Inactive accounts will abort 403
     */
    public function handle($request, Closure $next)
    {
        //Login Guests
        if(!Auth::user())
        {
            return redirect()->route('login');
        }

        //Check if the user is active
        if(Auth::user()->active)
        {
            return $next($request);
        }
        else
        {
            abort(403);
        }
    }
}
