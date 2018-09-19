<?php

namespace App\Http\Controllers;
use App\Event;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $currentEvent = Event::current();
        return view('index')->with('event', $currentEvent);
    }

    public function auction(){
        return view('auction');
    }

    public function previous(){
        return view('previous');
    }

    public function contenders(){
        return view('contenders');
    }

    public function contact(){
        return view('contact');
    }

    public function about(){
        return view('about');
    }
}
