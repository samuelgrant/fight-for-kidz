<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendTableEnquiry;
use App\Jobs\SendSponsorEnquiry;
use App\Jobs\SendGeneralEnquiry;

class ContactController extends Controller
{
    public function general(request $request) {
        $validator = Validator::make(Input::all(), [ // should this be $request->all() instead of Input::all()?
            'g-recaptcha-response' => 'required|captcha',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
        ],
        
        // error messages
        [
            'required' => ':attribute must be filled in',
            'accepted' => 'Please confirm that your details are correct'
        ]
    
    );

        // Send email notificaiton to admin email address
        SendGeneralEnquiry::dispatch($request->input('name'), $request->input('email'), $request->input('phone'), $request->input('message'));        
        
        session()->flash('success', 'Thanks, we\'ll get back to you asap!');
        return redirect()->back();
    }
    public function sponsor(request $request) {
        $validator = Validator::make(Input::all(), [ // should this be $request->all() instead of Input::all()?
            'g-recaptcha-response' => 'required|captcha',
            'name' => 'required',
            'email' => 'required|email',
            'type' => 'required',
            'phone' => 'required',
        ],
        
        // error messages
        [
            'required' => ':attribute must be filled in',
            'accepted' => 'Please confirm that your details are correct'
        ]
    
    );

        // Send message to the admin email account
        SendSponsorEnquiry::dispatch($request->input('name'), $request->input('email'), $request->input('phone'), $request->input('type'), $request->input('message'));
        
        session()->flash('success', 'Thanks, we\'ll get back to you asap!');
        return redirect()->back();
    }
    public function table(request $request) {
        $validator = Validator::make(Input::all(), [ // should this be $request->all() instead of Input::all()?
            'g-recaptcha-response' => 'required|captcha',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ],
        
        // error messages
        [
            'required' => ':attribute must be filled in',
            'accepted' => 'Please confirm that your details are correct'
        ]
    
    );        

        // Send message to the admin email account
        SendTableEnquiry::dispatch($request->input('name'), $request->input('email'), $request->input('phone'), $request->input('message'));

        session()->flash('success', 'Thanks, we\'ll get back to you asap!');
        return redirect()->back();
    }
}
