<?php

namespace App\Http\Controllers\admin;

use Auth;
use App\Event;
use GDText\Box;
use GDText\Color;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
     * 
     * 
     */
    public function view($eventID){

        $event = Event::find($eventID);

        return view('admin.eventManagement')->with('event', $event);

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

  /**
  * Inverts the is_public boolean of an event.
  *
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
        $box->setFontFace(dirname(dirname(dirname(dirname(dirname(__FILE__))))).'\storage\app\private\fonts\Ubuntu-BoldItalic.ttf');

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
        imagepng($image, '..\storage\app\public\images\f4k_logo.png');

        // Remove the image from memory
        imagedestroy($image);

        Log::debug('Logo updated. New logo year is '.$currentEventYear);
    }
}