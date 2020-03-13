<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Jobs\SendEnquiryRecipet;
use App\Jobs\SendEnquiry;
use App\Subscriber;
use App\ReceivedMessage;
use App\Event;

class ContactController extends Controller
{
    public function index(){
        return view('contact_us');
    }

    public function send(request $request) {
        


        $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => 'required|captcha',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required',
            
        ])->validate();

        if($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
        
            ), 400); // 400 being the HTTP code for an invalid request.
        }
           
        // Store the message in the database
        $this->storeMessage(ucfirst($request->input('type')), $request);

        // Send email notificaiton to admin email address
        SendEnquiry::dispatch($request->all());

        // Send receipt to sender
        $this->sendContactReceivedMail($request->input('email'), $request->input('name'), 'general');
        
        // Subscribe the sender if they requested it
        $this->checkSubscribed($request);
        
        return response('Your email has been received.', 202);
    }

    /**
     * Sends a notification to the given email and name, letting them
     * know that their enquiry has been received.
     */
    protected function sendContactReceivedMail($email, $name, $type){
        SendEnquiryRecipet::dispatch($name, $email, $type);
    }

    /**
     * Subscribes the sender if they have ticked the box stating 
     * that they wish to be subscribed.
     */
    protected function checkSubscribed(Request $request){
        if($request->input('subscribe') == "true"){
            Subscriber::subscribe($request->input('name'), $request->input('email'));
        }
    }

    /**
     *  Stores the message associated with the request in the database, 
     *  for future viewing.
     */
    public function storeMessage($type, $request){

        $message = new ReceivedMessage();

        $message->message_type = $type;
        $message->name = $request->input('name');
        $message->company_name = $request->input('company');
        $message->email = $request->input('email');
        $message->phone = $request->input('phone');
        $message->sponsorship_type = implode(', ', $request->input('sponsorshipTypes'));
        $message->message = $request->input('message');
        $message->event_id = Event::current()->id;

        $message->save();
    }
}
