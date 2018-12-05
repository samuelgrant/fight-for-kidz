<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendTableEnquiry;
use App\Jobs\SendSponsorEnquiry;
use App\Jobs\SendGeneralEnquiry;
use App\Jobs\SendContactReceived;

class ContactController extends Controller
{
    public function general(request $request) {
        $validator = Validator::make($request->all(), [
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
        
        // Send receipt to sender
        $this->sendContactReceivedMail($request->input('email'), $request->input('name'));

        // Subscribe the sender if they requested it
        $this->checkSubscribed($request);
        
        return view('feedback.received-contact');
    }
    public function sponsor(request $request) {
        $validator = Validator::make($request->all(), [ 
            'g-recaptcha-response' => 'required|captcha',
            'name' => 'required',
            'companyName' => 'required',
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
        SendSponsorEnquiry::dispatch($request->input('name'),$request->input('companyName'), $request->input('email'), $request->input('phone'), $request->input('type'), $request->input('message'));

        // Send receipt to sender
        $this->sendContactReceivedMail($request->input('email'), $request->input('name'));

        // Subscribe the sender if they requested it
        $this->checkSubscribed($request);
        
        return view('feedback.received-contact');
    }
    public function table(request $request) {
        $validator = Validator::make($request->all(), [ 
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

        // Send receipt to sender
        $this->sendContactReceivedMail($request->input('email'), $request->input('name'));

        // Subscribe the sender if they requested it
        $this->checkSubscribed($request);

        return view('feedback.received-contact');
    }

    /**
     * Sends a notification to the given email and name, letting them
     * know that their enquiry has been received.
     */
    protected function sendContactReceivedMail($email, $name){
        SendContactReceived::dispatch($name, $email);
    }

    /**
     * Subscribes the sender if they have ticked the box stating 
     * that they wish to be subscribed.
     */
    protected function checkSubscribed(Request $request){
        if($request->input('subscribeCheckbox')){
            Subscriber::subscribe($request->input('name'), $request->input('email'));
        }
    }
}
