<?php

namespace App\Http\Controllers;

use Input;
use App\Subscriber;
use App\Jobs\SendSubscribedEmail;
use App\Jobs\SendUnsubscribedEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
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
            SendSubscribedEmail::dispatch($subscriber);
            
            session()->flash('success', 'You have successfully subscribed');
        }else{
            session()->flash('error', 'This email address has already been signed up');
        }

        return Redirect::to(URL::previous(). "#subscriber-section");
    }

    public function showUnsubscribeForm(Request $request){

        return view('unsubscribeForm')->with('token', $request->token);

    }

    public function unsubscribe(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $token = $request->token;
        $email = $request->email;        

        $subscriber = Subscriber::where('email', $email)->get()->first();
        
        if($subscriber){

            if($subscriber->unsubscribe_token == $token)
            {               
                $subscriber->unsubscribe();

                // send mail notification
                SendUnsubscribedEmail::dispatch($email);

                return view('feedback.unsubscribed');
            } 
            else
            {
                session()->flash('error', 'There was an error. Please try again using the \'unsubscribe\' link on an email you have received.');
                return redirect()->back();
            }
        } 
        else
        {
            session()->flash('error', 'This address is not on our mailing lists. Please contact Fight for Kidz if you are still receiving mail from us');
            return redirect()->back();
        }

    }
}
