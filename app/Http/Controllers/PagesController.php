<?php

namespace App\Http\Controllers;
use App\Event;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $currentEvent = Event::current();
        return view('index')->with('event', $currentEvent);
    }
    
    public function contactGeneral(){
        return view('contact');
    }

    public function contactTable(){
        return view('contact-table');
    }

    public function contactSponsor(){
        return view('contact-sponsor');
    }
}
