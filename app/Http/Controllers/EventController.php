<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{  
    public function index($eventId) {
        
        if($eventId == null){
            $event = Event::current();
        } else{
            $event = Event::find($eventId);
        }

        return view('event')->with('event', $event);
    }
}
