<?php

namespace App\Http\Controllers;

use Input;
use App\Image;
use App\Applicant, App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Subscriber;
use App\Jobs\SendApplicationReceivedEmail;

class EventApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('event.application');
    }

    /**
     * Returns the fighter application form view
     */
    public function fighterForm(){
        return view('fighter-apply');
    }

    /**
     * Stores an application to fight in the upcoming event
     * 
     * @param request, googleCaptcha
     * @todo Full form validation & Sotring of data.
     */
    public function storeFighterApp(Request $request){
        $validator = Validator::make(Input::all(), [ // should this be $request->all() instead of Input::all()?
            // 'g-recaptcha-response' => 'required|captcha',

            //Contact Info Section
            'first_name' => 'required',
            'last_name' => 'required',
            'address_1' => 'required',
            // address_2 not required
            // suburb not required
            'city' => 'required',
            'post_code' => 'required',
            'email' => 'required|email',
            'phone_1' => 'required',

            //Personal Details Section
            'dob' => 'required|date', // string must be date according to PHP strtotime() function
            'height' => 'required|integer|gt:0',
            'current_weight' => 'required|integer|gt:0', 
            'expected_weight' => 'nullable|integer|gt:0',
            'occupation' => 'required',
            'gender' => 'required',
            'hand' => 'required',
            // nickname not required
            'sponsorRadio' => 'required',
            'photo' => 'required|image|mimes:jpeg,png', // accepts jpeg and png - this may not be correct

            //Emergency Contact Section
            'emergency_first' => 'required',
            'emergency_last' => 'required',
            'emergency_relationship' => 'required',
            'emergency_phone_1' => 'required',
            //emergency_phone_2 not required
            'emergency_email' => 'required',

            //Sporting Experience Section
            'expRadio' => 'required',
            'fitness_rating' => 'required',
            'fighting_experience' => 'required_if:expRadio,yes',
            'sporting_experience' => 'required',
            'hobbies' => 'required',

            //Medical Info Section
            //checkboxes aren't required
            'other_details' => 'required_if:other,on',
            'hand_details' => 'required_if:handRadio,yes',
            'injury_details' => 'required_if:injuryRadio,yes',
            'meds_details' => 'required_if:medsRadio,yes',
            'heartRadio' => 'required',
            'activityRadio' => 'required',
            'monthRadio' => 'required',
            'consciousnessRadio' => 'required',
            'boneRadio' => 'required',
            'bloodRadio' => 'required',
            'concussed_details' => 'required_if:concussedRadio,yes',
            'reason_details' => 'required_if:reasonsRadio,yes',

            //Additional Info Section
            'convictedRadio' => 'required',
            'conviction_details' => 'required_if:convictedRadio,yes',
            'drugRadio' => 'required',
            'declCheckbox' => 'accepted'

        ],
        
        // error messages
        [
            'required' => ':attribute must be filled in',
            'accepted' => 'Please check the declaration checkbox'
        ]
    
    );       

        Log::debug('Server is validating application submitted by ' . $request->input('first_name') . ' ' . $request->input('last_name') . ' from ' . $request->input('email'));

        if($validator->fails()){

            Log::info('Application submitted from ' . $request->input('email') . ' failed server validation.');            
            Log::info($validator->errors());
            
            return view('feedback.failed-submission')->withErrors($validator);
        }

        Log::debug('Server has successfully validated application submitted by ' . $request->input('first_name') . ' ' . $request->input('last_name') . ' from ' . $request->input('email'));        

        // also need to check if someone has already submitted
        // an application for this email address
        if(Applicant::where('email', $request->input('email'))->where('event_id', Event::current()->id)->get()->first() != null){

            Log::debug('An application from ' . $request->input('email') . ' has failed as there is already an application under this email address.');

            session()->flash('error', 'An application has already been submitted using this email address,
            please contact Fight for Kidz if this is an error, or if you wish to amend you application details.');
            return view('feedback.failed-submission');

        }

        // validator has not failed, so make the applicant record
        $applicant = new Applicant;
        //Contact Info Section
        $applicant->first_name = $request->input('first_name');
        $applicant->last_name = $request->input('last_name');
        $applicant->address_1 = $request->input('address_1');
        $applicant->address_2 = $request->input('address_2');
        $applicant->suburb  = $request->input('suburb');
        $applicant->city = $request->input('city');
        $applicant->postcode = $request->input('post_code');
        $applicant->phone_1 = $request->input('phone_1');
        $applicant->phone_2 = $request->input('phone_2');
        $applicant->email = $request->input('email');

        //Personal Details Section
        $applicant->dob = $request->input('dob'); // need to confirm that date is being stored appropriately
        $applicant->height = $request->input('height');
        $applicant->current_weight = $request->input('current_weight');
        $applicant->expected_weight = $request->input('expected_weight') ?? $request->input('current_weight'); // will use current weigt if expected weight is empty
        $applicant->occupation = $request->input('occupation');
        $applicant->employer = $request->input('employer');
        $applicant->is_male = $request->input('gender') == 'male' ? true : false;
        $applicant->right_handed = $request->input('hand') == 'right' ? true : false;
        $applicant->preferred_fight_name = $request->input('nickname');
        $applicant->can_secure_sponsor = $request->input('sponsorRadio') == 'yes' ? true : false;

        //Emergency Contact Section
        $applicant->emergency_first_name = $request->input('emergency_first');
        $applicant->emergency_last_name = $request->input('emergency_last');
        $applicant->emergency_relationship = $request->input('emergency_relationship');
        $applicant->emergency_phone_1 = $request->input('emergency_phone_1');
        $applicant->emergency_phone_2 = $request->input('emergency_phone_2');
        $applicant->emergency_email = $request->input('emergency_email');
        
        //Sporting Experience Section
        $applicant->fitness_rating = $request->input('fitness_rating');
        $applicant->boxing_exp = $request->input('fighting_experience');
        $applicant->sporting_exp = $request->input('sporting_experience');
        $applicant->hobbies = $request->input('hobbies');

        //Medical Info Section
        $applicant->heart_disease = $request->input('heart_disease') == 'on' ? true : false;
        $applicant->breathlessness = $request->input('heart_surgery') == 'on' ? true : false;
        $applicant->epilepsy = $request->input('heart_attack') == 'on' ? true : false;
        $applicant->heart_attack = $request->input('stroke') == 'on' ? true : false;
        $applicant->stroke = $request->input('smoking') == 'on' ? true : false;
        $applicant->heart_surgery = $request->input('cancer') == 'on' ? true : false;
        $applicant->respiratory_problems = $request->input('breathlessness') == 'on' ? true : false;
        $applicant->cancer = $request->input('epilepsy') == 'on' ? true : false;
        $applicant->irregular_heartbeat = $request->input('chest_pain_discomfort') == 'on' ? true : false;
        $applicant->smoking = $request->input('irregular_heartbeat') == 'on' ? true : false;
        $applicant->joint_pain_problems = $request->input('joint_pain_problems') == 'on' ? true : false;
        $applicant->chest_pain_discomfort = $request->input('respiratory_problems') == 'on' ? true : false;
        $applicant->hypertension = $request->input('surgery') == 'on' ? true : false;
        $applicant->surgery = $request->input('dizziness_fainting') == 'on' ? true : false;
        $applicant->dizziness_fainting = $request->input('high_cholesterol') == 'on' ? true : false;
        $applicant->high_cholesterol = $request->input('hypertension') == 'on' ? true : false;
        $applicant->other = $request->input('other_details');
        $applicant->hand_injuries = $request->input('hand_details');
        $applicant->previous_current_injuries = $request->input('injury_details');
        $applicant->current_medication = $request->input('meds_details');
        $applicant->heart_condition = $request->input('heartRadio') == 'yes' ? true : false;
        $applicant->chest_pain_activity = $request->input('activityRadio') == 'yes' ? true : false;
        $applicant->chest_pain_recent = $request->input('monthRadio') == 'yes' ? true : false;
        $applicant->lost_consciousness = $request->input('consciousnessRadio') == 'yes' ? true : false;
        $applicant->bone_joint_problems = $request->input('boneRadio') == 'yes' ? true : false;
        $applicant->recommended_medication = $request->input('bloodRadio') == 'yes' ? true : false;
        $applicant->concussed_knocked_out = $request->input('concussed_details');
        $applicant->other_reasons = $request->input('reason_details');
        
        //Additonal Info Section
        $applicant->conviction_details = $request->input('conviction_details');
        $applicant->consent_to_test = $request->input('drugRadio') == 'yes' ? true : false;

        // Note: Elvis operator used - PHP version 5.3 or greater required.
        // ?: means 'Uses what comes before if it evaluates true, else use what is after'
        $applicant->custom_one = $request->input('custom_1') ?: null;
        $applicant->custom_two = $request->input('custom_2') ?: null;
        $applicant->custom_three = $request->input('custom_3') ?: null;
        $applicant->custom_four = $request->input('custom_4') ?: null;
        $applicant->custom_five = $request->input('custom_5') ?: null;

        // set applicant event to current event
        $applicant->event()->associate(Event::current());

        try{
            $applicant->save(); // generates id number to use when generating image name
        }
        catch(\PDOException $ex){

            Log::error('Error saving applicant to database. Code: ' . $ex->getCode() . ' | ' . $ex->getMessage());

            if($ex->getCode() == 22007 || $ex->getCode() == '22007'){ // code for invalid date format
                session()->flash('error', 'Your application failed to submit correctly. Please ensure you follow the date format YYYY-MM-DD for your birth date.');
            }
            else{            
                session()->flash('error', 'Your application has failed to submit correctly due to a server error. Please try again, and if the issue persists, please contact Fight for Kidz.');
            }
            return view('feedback.failed-submission'); 
        }

        $image = $request->file('photo');
        $imagePath = 'private/images/applicants/';
        $imageName = $applicant->id . '.jpg'; 
        
        // Convert to png if needed and store
        Image::storeAsJpg($image, $imagePath, $imageName);

        // check if subscribe for updates checkbox is checked and that there is an email in the email field subscribe if so
        if($request->input('subscribeCheckbox') && $request->input('email')!= '' ){
            Subscriber::subscribe($request->input('first_name') . ' ' . $request->input('last_name'), $request->input('email'));
        }
        
        // send email notification of receipt
        SendApplicationReceivedEmail::dispatch($applicant->email, $applicant->first_name);

        // show feedback page
        return view('feedback.received-app');
    }

    /**
     * Stores an application to become a sponsor in the upcoming
     * event.
     * 
     * @param request, googleCaptcha
     * @todo Full form validation & Sotring of data.
     */
    public function storeSponsorApp(Request $request){
        $validate = Validator::make(Input::all(), [
            'g-recaptcha-response' => 'required|captcha'
        ]);

        abort(501);


        // if validation passess

    }
}
