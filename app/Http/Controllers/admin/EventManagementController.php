<?php

namespace App\Http\Controllers\admin;

use Auth;
use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class EventManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.activeUser');
    }

    /**
     * Displays the eventManagment view.
     * 
     */
    public function index(){

        $events = Event::get();
        $deletedEvents = Event::onlyTrashed()->get();
        return view('admin.eventManagement')->with(['events' => $events, 'deletedEvents' => $deletedEvents]);
    }

    /**
     * Creates a new event with the default state not public
     * 
     * @param request
     */
    public function store(request $request){

        $event = new Event();
            $event->name = $request->input('eventName');
            $event->datetime = new carbon($request->input('dateTime'));
            $event->venue_name = $request->input('venueName');
            $event->venue_address = $request->input('venueAddress');
        $event->save();

        $event->updateGPS();

        session()->flash('success', 'The event called '.$event->name.' was created.');
        return redirect()->back();
    }
    /**
     * Soft deletes selected event
     * 
     * @param $id
     */
    public function destroy($id)
    {
        $event = Event::find($id);
            $event->is_public = false;
            $event->save();

            $event->delete();
            session()->flash('success', 'The event called '.$event->name.' was deleted.');
    
        return redirect()->back();
    }

    /**
     * Restores soft deleted selected event
     * 
     * @param $id
     */
    public function restore($id){

        $event = Event::withTrashed()->find($id);
        $event->restore();
        session()->flash('success', 'The event called '.$event->name.' was restored.');

        return redirect()->back();
    }
}