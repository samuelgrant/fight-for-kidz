<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AuctionItem;

class AuctionManagementController extends Controller
{
    // /**
    //  * Creates a new event with the default state not public
    //  * 
    //  * @param request
    //  */
    // public function store(request $request){

    //     $event = new Event();
    //         $event->name = $request->input('eventName');
    //         $event->datetime = new carbon($request->input('dateTime'));
    //         $event->venue_name = $request->input('venueName');
    //         $event->venue_address = $request->input('venueAddress');
    //     $event->save();

    //     $event->updateGPS();

    //     session()->flash('success', 'The event called '.$event->name.' was created.');
    //     return redirect()->back();
    // }

    // /**
    //  *  Updates event
    //  */
    // public function update(Request $request, $eventID){
    //     $validator = Validator::make(Input::all(), [ 
    //         'name' => 'required',
    //         'tickets' => 'active_url',

    //     ],        
    //     // error messages
    //     [
    //         'required' => ':attribute must be filled in',
    //         'accepted' => 'Please confirm that your details are correct',
    //         'url' => 'Please enter a valid URL'
    //     ]
    
    // )->validate();


    //     $event = Event::find($eventID);

    //     $event->name = $request->input('name');
    //     $event->datetime = $request->input('date');
    //     $event->venue_name = $request->input('venue');
    //     $event->venue_address = $request->input('address');
    //     $event->charity = $request->input('charity');
    //     $event->ticket_seller_url = $request->input('tickets');
    //     $event->desc_1 = $request->input('eventDesc');

    //     $event->updateGPS();

    //     $event->save();

    //     // We will also update the logo if the event is public. 
    //     // This will only change the logo if the modified event
    //     // is the 'current' event (i.e. most recent public event)
    //     $this->updateLogo();

    //     session()->flash('success', $event->name . ' was updated.');

    //     return redirect()->back();

    // }


    /**
     * Soft deletes selected auction item
     * 
     * @param $id
     */
    public function destroy($id)
    {
        $item = AuctionItem::find($id);
        $item->delete();
        session()->flash('success', 'The auction item '.$item->name.' was deleted.'); 
        
        return redirect()->back();
    }

    /**
     * Restores selected soft deleted auction item
     * 
     * @param $id
     */
    public function restore($id){

        $item = AuctionItem::withTrashed()->find($id);
        $item->restore();
        session()->flash('success', 'The auction item '.$item->name.' was restored');

        return redirect()->back();
    }
}
