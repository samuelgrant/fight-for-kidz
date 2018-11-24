<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Event;
use App\User, App\Subscriber, App\Sponsor, App\Applicant;
use App\Mail\CustomMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.activeUser');
    }

    public function index(){
        return view('admin.mail');
    } 

    public function previewMail($messageText){

        return new CustomMail('<name here>', $messageText);

    }

    public function sendMail(Request $request){

        $this->validate($request, [
            'subject' => 'required|string',
            'messageText' => 'required|string',
            'target_groups' => 'required',
        ]);    

        $recipients = $this->getRecipients($request->input('target_groups'));

        foreach($recipients as $recipient){



        }
    }

    /**
     * Given an array of system group names and/or custom group IDs,
     * this method returns an array of unique email addresses which it
     * returns.
     * 
     * @param array $groups
     * 
     * @return array
     */
    private function getRecipients($groups) {

        $recipients = [];        

        // Add all contacts for system groups

        if(in_array('admins', $groups)){
            foreach(User::all() as $user){
                $recipients[] = ['email' => $user->email, 'name' => $user->name];
            }
        }

        if(in_array('applicants', $groups)){
            foreach(Applicant::where('event_id', Event::current()->id)->get() as $applicant){
                $recipients[] = ['email' => $applicant->email, 'name' => $applicant->first_name];
            }
        }

        if(in_array('sponsors', $groups)){
            foreach(Sponsor::all() as $sponsor){
                $recipients[] = ['email' => $sponsor->email, 'name' => $sponsor->contact_name];
            }
        }

        if(in_array('subscribers', $groups)){
            foreach(Subscriber::all() as $subscriber){
                $recipients[] = ['email' => $subscriber->email, 'name' => $subscriber->name];
            }
        }

        // Add all contacts for custom groups

        foreach($groups as $group){
            if(!in_array($group, ['admin', 'applicants', 'sponsors', 'subscribers'])){
                $groupObject = Group::find($group);

                if($groupObject){
                    $groupRecipients = $groupObject->recipients();

                    foreach($groupRecipients as $groupRecipient){
                        $recipients[] = ['email' => $groupRecipient['email'], 'name' => $groupRecipient['name']];
                    }
                }                
            }
        }

        // trim duplicate emails from array https://stackoverflow.com/questions/307674/how-to-remove-duplicate-values-from-a-multi-dimensional-array-in-php

        $emails = array_column($recipients, 'email'); // get all emails 
        $emails = array_unique($emails); // reduce to unique emails
        $recipients = array_filter($recipients, function($key, $value) use ($emails){
            return in_array($value, array_keys($emails));
        }, ARRAY_FILTER_USE_BOTH);

        dd($recipients);

        return $recipients;
    }
}
