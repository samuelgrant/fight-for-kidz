<?php

namespace App\Http\Controllers;

use App\Event;
use App\Contender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{  
    public function index($eventName) {

        if($eventName == null){
            $event = Event::current();
        } else{
            $event = Event::where('name', str_replace('-', ' ', $eventName))->first();
        }

        return view('event')->with('event', $event);
    }

    public function getContender($contenderID){

        $contender = Contender::find($contenderID);
        

        if($contender){
            return ['contender' => $contender, 'age' => $contender->applicant->getAge()];
        } else{
            return response('No contender found', 400);
        }

    }
}
