<?php

namespace App\Http\Middleware;

use Auth;
use App\User;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;
use Illuminate\Http\Request;

class maintenanceModeOverride
{
    protected $request;
    protected $app;

    public function __construct(Application $app, Request $request)
    {
        $this->app = $app;
        $this->request = $request;
        return $request;
    }

    /**
     * Only allows admin access during Maintenance mode
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     */
    public function handle($request, Closure $next)
    {
        if($this->app->isDownForMaintenance()){
            if(Auth::guest() || Auth::user() && Auth::user()->active == false)
            {
                abort(503);
            } 

            session()->flash('maintenance', true);
        }
        return $next($request);
    }
}
