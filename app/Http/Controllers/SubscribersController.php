<?php

namespace App\Http\Controllers;

use Input;
use App\Subscriber;
use App\Mail\Subscribed;
use App\Mail\Unsubscribed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SubscribersController extends Controller
{
    /**
     * Adds a person to the subscribers table
     * 
     * @param request
     */
    public function store(Request $request){
        $validate = Validator::make(Input::all(), [
            'g-recaptcha-response' => 'required|captcha',
            'name' => 'required',
            'email' => 'required|email',
        ]);

        
        /**
         * Make sure the contact isn't already a subscriber.
         * Then add their info to the subscriber table
         * Then add them to system group 2 (subscribers).
         */
        if(!Subscriber::where('email', $request->input('email'))->count()){
            $subscriber = new Subscriber;
            $subscriber->name = $request->input('name');
            $subscriber->email = $request->input('email');
            $subscriber->unsubscribe_token = Hash::make($request->email . uniqid());
            $subscriber->save();

            // send mail notification of subscription
            Mail::to($subscriber->email)->send(new Subscribed($subscriber));

            $subscriber->addToGroup(2);
            session()->flash('success', 'You have successfully subscribed');
        }else{
            session()->flash('error', 'This email address has already been signed up');
        }

        return Redirect::to(URL::previous(). "#subscriber-section");
    }

    public function showUnsubscribeForm($token){

        return view('unsubscribeForm')->with('token', $token);

    }
}
