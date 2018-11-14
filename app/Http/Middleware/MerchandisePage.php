<?php

namespace App\Http\Middleware;

use Closure;
use App\SiteSetting;
use Symfony\Component\HttpFoundation\Response;

class MerchandisePage
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
        if(SiteSetting::getSettings()->display_merch){
            return $next($request);
        }
        else{
            // user will be redirected to the home page if they try accessing merch
            // page by entering URL.
            return redirect('/');
        }
    }
}
