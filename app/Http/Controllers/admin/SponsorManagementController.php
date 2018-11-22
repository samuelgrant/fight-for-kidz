<?php

namespace App\Http\Controllers\admin;

use App\Sponsor, App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SponsorManagementController extends Controller
{
    public function index(){

        $sponsors = Sponsor::all();

        return view('admin.sponsorsManagement')->with('sponsors', $sponsors);

    }

    public function view($sponsorID){

        $sponsor = Sponsor::find($sponsorID);

        return view('admin.sponsorManagement')->with('sponsor', $sponsor);

    }
    
    public function store(Request $request){

        // validate inputs here
        $this->validate($request, [
            'companyName' => 'required',
            'phone' => 'required',
            'email' => 'email|required',
            'url' => 'active_url',
            // 'logo' => 'mimes:png'
        ]);

        $sponsor = new Sponsor;

        // assign inputs here
        $sponsor->company_name = $request->input('companyName');
        $sponsor->contact_name = $request->input('contactName');
        $sponsor->contact_phone = $request->input('phone');
        $sponsor->email = $request->input('email');
        $sponsor->url = $request->input('url');

        // save sponsor to generate id
        $sponsor->save();

        $logoImage = $request->file('logo');
        $sponsor->setImage($logoImage);

        session()->flash('success', $sponsor->company_name . ' was successfully created');
        return redirect()->back();

    }

    public function update($sponsorID, Request $request){

        $sponsor = Sponsor::find($sponsorID);

        // validate inputs here
        $this->validate($request, [
            'companyName' => 'required',
            'phone' => 'required',
            'email' => 'email|required',
            'url' => 'active_url',
            // 'logo' => 'mimes:png'
        ]);

        // assign inputs here
        $sponsor->company_name = $request->input('companyName');
        $sponsor->contact_name = $request->input('contactName');
        $sponsor->contact_phone = $request->input('phone');
        $sponsor->email = $request->input('email');
        $sponsor->url = $request->input('url');

        $logoImage = $request->file('logo');
        $sponsor->setImage($logoImage);

        $sponsor->save();

        session()->flash('success', 'Details for ' . $sponsor->company_name . ' updated successfully');
        return redirect()->back();
    }

    /**
     * Deletes the sponsor only if the sponsor is not a sponsor in
     * any events.
     */
    public function deleteSponsor($sponsorID){

        $sponsor = Sponsor::find($sponsorID);

        if(count($sponsor->events) > 0){

            // cannot delete sponsor as they are linked to events

            session()->flash('error', $sponsor->company_name . ' cannot be deleted as it is linked to ' . count($sponsor->events) . ' events.');           

        } else {

            $sponsor->delete();

            session()->flash('success', $sponsor->company_name . ' was successfully deleted.');

        }

        return redirect()->back();

    }
    
    public function addToEvent($sponsorID, Request $request){

        $sponsor = Sponsor::find($sponsorID);
        $event = Event::find($request->input('eventID'));

        $sponsor->addToEvent($event);

        session()->flash('success', $sponsor->company_name . ' was added to ' . $event->name);

        return redirect()->back();

    }

    public function removeFromEvent($sponsorID, $eventID){

        $sponsor = Sponsor::find($sponsorID);
        $event = Event::find($eventID);

        if(count($sponsor->boutsForEvent($eventID)) > 0 || count($sponsor->contendersForEvent($eventID)) > 0){

            session()->flash('error', 'Cannot remove this sponsor while they sponsor bouts/contenders in this event.');

            return redirect()->back();

        } else {

            $sponsor->removeFromEvent($event);

            session()->flash('success', $sponsor->company_name . ' was removed from ' . $event->name);

            return redirect()->back();

        }
    }
}
