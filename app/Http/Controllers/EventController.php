<?php

namespace App\Http\Controllers;

use App\Event;
use App\Contender, App\Bout, App\AuctionItem, App\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
class JsonPackage{};

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
            return [
                'id' => $contender->id,
                'first_name' => $contender->first_name,
                'last_name' => $contender->last_name,
                'nickname' => $contender->nickname,
                'bio_url' => $contender->bio_url,
                'bio_text' => $contender->bio_text,
                'sponsor_id' => $contender->sponsor_id,
                'sponsor_url' => $contender->sponsor_id ? Sponsor::find($contender->sponsor_id)->url : null,
                'team' => $contender->team,
                'height' => $contender->height,
                'weight' => $contender->weight,
                'reach' => $contender->reach,
                'age' => $contender->applicant->getAgeOnEventDate()
            ];
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

    /**
     * finds and returns auction item
     * 
     * @param id
     */
    public function getAuctionItem($id){
        $item = AuctionItem::find($id);
        if($item == null){
            return response("No item found", 400);
        }
        
        return [
            'id' => $item->id,
            'name' => $item->name,
            'desc' => $item->desc,
            'donor' => $item->donor,
            'donor_url' => $item->donor_url
        ];
    }

    public function fightVideoModal($boutID){

        $bout = Bout::find($boutID);
        // Return 404 if bout is not found.
        if($bout == null){
            return response("No bout found", 404);
        }


        $red = Contender::find($bout->red_contender_id);
        $blue = Contender::find($bout->blue_contender_id);

        return [
            'red_contender' => $red->first_name . ' ' . $red->last_name,
            'blue_contender' => $blue->first_name . ' ' . $blue->last_name,
            'video_URL' => $bout->video_url
        ];    
    }
}
