<?php

namespace App\Http\Controllers;

use Input;
use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SubscribersController extends Controller
{
    //stores subscriber info into database
    public function store(Request $request){
        $validate = Validator::make(Input::all(), [
            'g-recaptcha-response' => 'required|captcha'
        ]);

        
        if(!Subscriber::where('email', $request->input('email'))->count()){
            $subscriber = new Subscriber;
            $subscriber->name = $request->input('name');
            $subscriber->email = $request->input('email');
            $subscriber->save();

            session()->flash('success', 'You have successfully subscribed');
        }else{
            session()->flash('error', 'This email address has already been signed up');
        }

        return Redirect::to(URL::previous(). "#subscriber-section");
    }
}
