<?php

namespace App\Http\Controllers\admin;

use Auth;
use Input;
use Validator;
use App\Event, App\Image;
use App\Applicant;
use GDText\Box;
use GDText\Color;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Contender, App\Bout, App\Sponsor;

class EventManagementController extends Controller
{
    /**
     * Displays the eventManagment view.
     * 
     */
    public function index(){

        $events = Event::get();
        $deletedEvents = Event::onlyTrashed()->get();
        return view('admin.eventsManagement')->with(['events' => $events, 'deletedEvents' => $deletedEvents]);
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
     * Returns event management view for specific event
     */
    public function view($eventID){

        $event = Event::find($eventID);
        if($event == null) {
            session()->flash('error', 'We could not find that event.');
            return redirect(route('admin.eventManagement'));
        }

        return view('admin.eventManagement')->with('event', $event);

    }

    /**
     *  Updates event
     */
    public function update(Request $request, $eventID){
        $validator = Validator::make(Input::all(), [ 
            'name' => 'required',
            'tickets' => 'active_url',
        ],        
        // error messages
        [
            'required' => ':attribute must be filled in',
            'accepted' => 'Please confirm that your details are correct',
            'url' => 'Please enter a valid URL'
        ]
    
    )->validate();


        $event = Event::find($eventID);

        $event->name = $request->input('name');
        $event->datetime = $request->input('date');
        $event->venue_name = $request->input('venue');
        $event->venue_address = $request->input('address');
        $event->charity = $request->input('charity');
        $event->charity_url = $request->input('charityUrl');
        $event->ticket_seller_url = $request->input('tickets');
        $event->desc_1 = $request->input('eventDesc');
        $event->event_sponsor = $request->input('eventSponsor');               

        if($image = $request->file('charityLogo'))
        {
            Image::storeAsPng($image, 'public/images/charity/', $event->id . '.png');
        }

        $event->save();

        if($event->venue_address != $request->input('address')){
            $event->updateGPS();      
        } 

        // We will also update the logo if the event is public. 
        // This will only change the logo if the modified event
        // is the 'current' event (i.e. most recent public event)
        $this->updateLogo();

        session()->flash('success', $event->name . ' was updated.');

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
            
        if(!$event->is(Event::current())){
            $event->is_public = false;
            $event->save();

            $event->delete();
            session()->flash('success', 'The event called '.$event->name.' was deleted.');
        } else{
            session()->flash('error', 'Please turn off public visibility before deleting this event');
        }
    
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

    /**
    * Inverts the is_public boolean of an event.
    * @param $id
    */
    public function togglePublic($id){
        $event = Event::find($id);

        if($event->is_public){
            if(count(Event::where('is_public', true)->get()) > 1 ){
                $event->makeNotPublic();            
            }
            else {
                session()->flash('error', 'You must have at least one event publicly visible');
                return redirect()->back();
            }
        } 
        else {
            $event->makePublic();
        }

        /*
        * As the above code will likely change the which event is 'current'
        * we will update the logo image with the correct year. If the current
        * event did not change, then no harm will be done.
        */
        $this->updateLogo();

        $visibility = $event->is_public ? 'public' : 'private';
        session()->flash('success', $event->name.' was made '.$visibility);
        return redirect()->back();
    }

    /**
     *  Toggle bouts visibitiy on event page.
     */
    public function toggleBouts($eventID){
        
        $event = Event::find($eventID);

        if($event){ //toggle the bout visibility
            if($event->show_bouts){
                $event->hideBouts();
                session()->flash('success', $event->name . ' bouts will NOT show on public page');
            } else{
                $event->showBouts();
                session()->flash('success', $event->name . ' bouts WILL show on public page');
            }
        } else{ // if for some reason the eventID does not find an event
            session()->flash('error', 'Error. The requested action could not be completed.');
        }

        return redirect()->back();
    }

    /**
     *  Toggle bouts visibitiy on event page.
     */
    public function toggleAuctions($eventID){
        
        $event = Event::find($eventID);

        if($event){ //toggle the auction visibility
            if($event->show_auctions){
                $event->hideAuctions();
                session()->flash('success', $event->name . ' auctions will NOT show on public page');
            } else{
                $event->showAuctions();
                session()->flash('success', $event->name . ' auctions WILL show on public page');
            }
        } else{ // if for some reason the eventID does not find an event
            session()->flash('error', 'Error. The requested action could not be completed.');
        }

        return redirect()->back();
    }

    /**
     *  This method toggles whether the event is open for applications or 
     *  not. Visitors to the site will only be able to apply if the current 
     *  event is open for applications.
     */
    public function toggleApplications($eventId){

        $event = Event::find($eventId);

        if($event->setApplications(!($event->open))){
            $apps = $event->open ? 'on' : 'off';
            session()->flash('success', 'Applications were turned ' . $apps . ' for ' . $event->name);
        } else{
            session()->flash('error', 'Cannot turn applications on for an event in the past.');
        }

        return redirect()->back();




    }


    /**
     *  This function uses the gd and stil/gd-text libraries.
     *  It takes the blank logo in the private storage area, 
     *  and creates a new, dated logo in the public storage 
     *  area. 
     * 
     *  use GDText\Box;
     *  use GDText\Color;
     * 
     *  This function should be run every time the year on
     *  the logo needs changing. 
     * 
     *  The easiest way to do this will probably be to call
     *  this function whenever an event's public visibility 
     *  is changed. 
     */
    public function updateLogo(){

        $currentEventDate = Event::current()->datetime;

        $currentEventYear = Carbon::parse($currentEventDate)->format('Y');

        // Creates the image in memory from the private storage directory
        $image = imagecreatefrompng('../storage/app/private/images/f4k_logo_noyear.png');
    
        // Sets transparent color to transparent black.
        imagecolortransparent($image, imagecolorallocatealpha($image, 0,0,0,0));

        $box = new Box($image);

        // Set font .ttf file. Feel free to change the nested dirnames if you can find something that definitely works.
        $box->setFontFace(dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/storage/app/private/fonts/Ubuntu-BoldItalic.ttf');

        // Set the text properties
        $box->setFontColor(new Color(255,255,255));    
        $box->setFontSize(140);

        // Set the text outline
        $box->setStrokeColor(new Color(0,0,1));
        $box->setStrokeSize(3);

        // Add shadow effect color, xOffset, yOffset
        $box->setTextShadow(new Color(0,0,1), 10, 10);

        // Set textbox xPos, yPos, width, heigh
        $box->setBox(20,190,320,135);

        // Text alignment within text box
        $box->setTextAlign('left', 'top');

        // Draw to the image in memory
        $box->draw($currentEventYear);

        // Output the image to the public storage directory
        imagepng($image, '../storage/app/public/images/f4k_logo.png');

        // Remove the image from memory
        imagedestroy($image);

        Log::info('Logo updated. New logo year is '.$currentEventYear);
    }    
        
}
