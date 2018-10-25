<?php

namespace App\Http\Controllers\admin;

use App\Event;
use App\Bout;
use App\Contender;
use App\Sponsor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BoutManagementController extends Controller
{
    public function removeBout($boutId){

        $bout = Bout::find($boutId);
        $bout->delete();
    }

    public function addBout($eventId){

        $event = Event::find($eventId);

        $bout = new Bout();
        $bout->event()->associate($event);
        $bout->save();

    }

    /**
     *  Updates bout contenders and sponsor.
     * 
     *  Used on the event management page when 
     *  user changes a dropdown value.
     */
    public function updateBoutDetails($boutId, Request $request){

        $bout = Bout::find($boutId);

        $bout->red_contender()->associate(Contender::find($request->input('red')));
        $bout->blue_contender()->associate(Contender::find($request->input('blue')));
        $bout->sponsor()->associate(Sponsor::find($request->input('sponsor')));
        $bout->video_url = $request->input('video');

        $victor = Contender::find($request->input('winner'));

        if($bout->red_contender == null || $bout->blue_contender == null || $victor != $bout->red_contender && $victor != $bout->blue_contender){
            $bout->victor()->dissociate();
        } else{
            $bout->victor()->associate($victor);
        }

        $bout->save();
        
        return redirect()->back();
    }
}
