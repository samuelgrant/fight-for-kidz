<?php

namespace App\Http\Controllers;

use App\Event;
use App\Contender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function getContender($contenderID){

        $contender = Contender::find($contenderID);

        if($contender){
            return ['contender' => $contender, 'applicant' => $contender->applicant];
        } else{
            return response('No contender found', 400);
        }

    }
}
