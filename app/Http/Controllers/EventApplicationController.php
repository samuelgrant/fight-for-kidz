<?php

namespace App\Http\Controllers;

use Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventApplicationController extends Controller
{
    public function index(){
        return view('apply');
    }

    /**
     * Stores an  application to fight in an event.
     */
    public function store(){
        $validate = Validator::make(Input::all(), [
            'g-recaptcha-response' => 'required|captcha'
        ]);

        abort(501);
    }
}