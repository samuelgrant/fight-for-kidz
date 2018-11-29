<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        session()->flash('success', 'Thanks, we\'ll get back to you asap!');
        return redirect()->back();
    }
}
