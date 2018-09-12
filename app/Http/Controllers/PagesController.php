<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('index');
    }

    public function auction(){
        return view('auction');
    }

    public function previous(){
        return view('previous');
    }

    public function contenders(){
        return view('contenders');
    }

    public function contact(){
        return view('contact');
    }

    public function about(){
        return view('about');
    }
}
