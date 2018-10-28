<?php

namespace App\Http\Middleware;

use Closure;
use App\Event;

class EventApplication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Event::current()->is_public && Event::current()->open && Event::current()->isFutureEvent()) 
        {
            return $next($request);
        } else {
            session()->flash('error', 'We are not accepting applications at this time.');
            return redirect()->back();
        }
    }
}
