<?php

namespace App\Http\Controllers;

use App\Sponsor, App\Event;
use Illuminate\Http\Request;

class SponsorManagementController extends Controller
{
    public function index(){

        $sponsors = Sponsor::all();

        return view('admin.sponsorsManagement')->with('sponsors', $sponsors);

    }
    
    public function store(Request $request){

        // validate inputs here

        $sponsor = new Sponsor;

        // assign inputs here

        // save sponsor to database
        //$sponsor->save();

    }

    /**
     * Deletes the sponsor only if the sponsor is not a sponsor in
     * any events.
     */
    public function deleteSponsor($sponsorID){

        $sponsor = Sponsor::find($sponsorID);

        if(count($sponsor->events > 0)){

            // cannot delete sponsor as they are linked to events

            session()->flash('error', 'This sponsor cannot be deleted as it is linked to ' . count($sponsor->events) . '.');
             
            return redirect()->back();

        } else {

            $sponsor->delete();

            session()->flash('success', $sponsor->company_name . ' was successfully deleted.');

        }

    }
    
    public function addToEvent($sponsorID, $eventID){

        $sponsor = Sponsor::find($sponsorID);
        $event = Event::find($eventID);

        $sponsor->addToEvent($event);

        session()->flash('success', $sponsor->company_name . ' was added to ' . $event->name);

        return redirect()->back();

    }

    public function removeFromEvent($sponsorID, $eventID){

        $sponsor = Sponsor::find($sponsorID);
        $event = Event::find($eventID);

        $sponsor->removeFromEvent($event);

        session()->flash('success', $sponsor->company_name . ' was removed from ' . $event->name);

        return redirect()->back();

    }
}
