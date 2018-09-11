<?php

namespace App\Http\Controllers\admin;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;

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
     * Soft deletes selected event
     * 
     * @param $id
     */
    public function destroy($id)
    {
        $event = Event::find($id);

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
