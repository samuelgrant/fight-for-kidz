<?php

namespace App\Http\Controllers;

use App\Event;
use App\Contender, App\Bout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

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

    public function getBout($boutID){
        
        $bout =  Bout::find($boutID);

        if($bout){
            return ['bout' => $bout];
        } else{
            return response('No bout found', 400);
        }
    }

    public function fightVideoModal($boutID){

        $bout = Bout::find($boutID);
        $red = Contender::find($bout->red_contender_id);
        $blue = Contender::find($bout->blue_contender_id);

        if($bout == null){
            return response("No bout found", 404);
        }

        $varPayload = new Response();
            $varPayload->red_contender = $red->first_name . ' ' . $red->last_name;
            $varPayload->blue_contender = $blue->first_name . ' ' . $blue->last_name;
            $varPayload->video_URL = $bout->video_url;
        
        return response($varPayload, 200);
    
    }
}
