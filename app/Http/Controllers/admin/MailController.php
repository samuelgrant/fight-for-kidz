<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use App\Event;
use App\Contender;
use App\User, App\Subscriber, App\Sponsor, App\Applicant;
use App\Mail\CustomMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendCustomMail;
use Illuminate\Support\Facades\Storage;
use Purifier;
use Illuminate\Support\Facades\Log;

class MailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.activeUser');
    }

    public function index(){
        return view('admin.mail');
    }
    
    public function presetTarget(Request $request){
        return view('admin.mail')->with('targetGroup', $request->input('groupID'));
    }

    /**
     * Returns the preview as html
     */
    public function previewMail(Request $request){

        $empty = []; // have to pass an array
        $messageText = $request->messageText;

        return new CustomMail('test@example.com', '<name here>', '<Subject here>', $messageText, $empty);
    }

    public function sendMail(Request $request){

        $this->validate($request, [
            'subject' => 'required|string',
            'messageText' => 'required|string',
            'target_groups' => 'required',
            'messageAttachments.*' => 'max:5000|mimes:doc,docx,bmp,gif,jpg,jpeg,png,pdf,rtf,xls,xlsx,txt',
        ]);
        
        $subject = $request->input('subject');
        $messageText = $request->input('messageText');

        // Purify the input to remove malicious scripts / dangerous html tags
        $messageText = Purifier::clean($messageText);
        
        // Start of attachment processing.

        $messageAttachments = $request->messageAttachments;
        $attachmentDetails = [];

        // store files to disk, temporarily, and pass the path to the job.
        if($messageAttachments){
            foreach($messageAttachments as $file){
                
                $filename = $file->getClientOriginalName();
                $fileMime = $file->getClientMimeType();
                $storedName = Storage::disk('temp')->put('/', $file);
                $storedPath = storage_path('app/private/temp/') . $storedName;
                $attachmentDetails[] = ['filename' => $filename, 'fileMime' => $fileMime, 'storedName' => $storedName, 'storedPath' => $storedPath];          
            }
        }

        // end of attachment processing

        $recipients = $this->getRecipients($request->input('target_groups'));

        foreach($recipients as $email => $name){

            SendCustomMail::dispatch($email, $name, $subject, $messageText, $attachmentDetails);
                    
        }


        session()->flash('success', 'Emails will send in the background.');

        return redirect()->back();
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
        
        foreach($groups as $groupName){

            if($groupName == 'subscribers'){
                foreach(Subscriber::all() as $subscriber){                    
                    $recipients[] = ['email' => $subscriber->email, 'name' => $subscriber->name];
                }
            }
            elseif($groupName == 'admins'){
                foreach(User::all() as $user){
                    $recipients[] = ['email' => $user->email, 'name' => $user->name];
                }
            }
            else{
                $s = explode('-', $groupName);
                
                if($s[0] == 'red'){
                    foreach(Contender::where([['team', 'red'],['event_id', $s[1]]])->get() as $contender){
                        $recipients[] = ['email' => $contender->applicant->email, 'name' => $contender->first_name];
                    }
                }
                elseif($s[0] == 'blue'){
                    foreach(Contender::where([['team', 'blue'],['event_id', $s[1]]])->get() as $contender){
                        $recipients[] = ['email' => $contender->applicant->email, 'name' => $contender->first_name];
                    }
                }
                elseif($s[0] == 'applicants'){
                    foreach(Applicant::where('event_id', $s[1])->get() as $applicant){
                        $recipients[] = ['email' => $applicant->email, 'name' => $applicant->first_name];
                    }
                }
                elseif($s[0] == 'sponsors'){
                    foreach(Sponsor::all() as $sponsor){
                        if(Event::find($s[1])->sponsors->contains($sponsor)){
                            $recipients[] = ['email' => $sponsor->email, 'name' => $sponsor->contact_name ?? $sponsor->company_name];
                        }
                    }
                }
                elseif($s[0] == 'group'){

                    $groupObject = Group::find($s[1]);                    
                    
                    if($groupObject){
                        $groupRecipients = $groupObject->recipients();
    
                        foreach($groupRecipients as $groupRecipient){
                            $recipients[] = ['email' => $groupRecipient['email'], 'name' => $groupRecipient['name']];
                        }
                    } 
                }
            }
        }
        ($recipients);

        $recipientsTrimmed = [];

        foreach($recipients as $recipient){
            
            if(!array_key_exists($recipient['email'], $recipientsTrimmed)){
                $recipientsTrimmed[$recipient['email']] = $recipient['name'];
            }
            else{
                Log::Debug($recipient['name'] . ' omitted from recipients as the email address '
                . $recipient['email'] . ' already exists in the recipients list.');
            }
        }

        return $recipientsTrimmed;

        // trim duplicate emails from array https://stackoverflow.com/questions/307674/how-to-remove-duplicate-values-from-a-multi-dimensional-array-in-php

        // $emails = array_column($recipients, 'email'); // get all emails 
        // $emails = array_unique($emails); // reduce to unique emails
        // $recipients = array_filter($recipients, function($key, $value) use ($emails){
        //     return in_array($value, array_keys($emails));
        // }, ARRAY_FILTER_USE_BOTH);
    }
}
