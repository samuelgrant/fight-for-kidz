<?php

namespace App\Http\Controllers;

use Cookie;
use Illuminate\Http\Request;

class CookieController extends Controller
{
    public function action(){
        // 60 Days, 60 minutes * 24 hours * 60 days
        Cookie::queue(Cookie::make('cookieconsent', 'accepted', 60 * 24 * 60));
    }
}
