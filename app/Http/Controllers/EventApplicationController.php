<?php

namespace App\Http\Controllers;

use Input;
use App\Image;
use App\Applicant, App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Subscriber;

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
     * Returns the sposnor application form view
     */
    public function sponsorForm(){
        return view('sponsor-apply');
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
            'phone' => 'required',
            // mobile not required

            //Personal Details Section
            'dob' => 'required|date', // string must be date according to PHP strtotime() function
            'height' => 'required|integer|gt:0',
            'current_weight' => 'required|integer|gt:0', 
            'expected_weight' => 'integer|gt:0',
            'occupation' => 'required',
            'gender' => 'required',
            'hand' => 'required',
            // nickname not required
            'sponsorRadio' => 'required',
            'photo' => 'required|image|mimes:jpeg,png', // accepts jpeg and png - this may not be correct

            //Emergency Contact Section
            'emergency_first' => 'required',
            'emergency_last' => 'required',
            'emergency_phone' => 'required',
            'emergency_mobile' => 'required',
            'emergency_email' => 'required',

            //Sporting Experience Section
            'expRadio' => 'required',
            'fitness_rating' => 'required',
            'fighting_experience' => 'required_if:expRadio,yes',
            'sporting_experience' => 'required',
            'hobbies' => 'required',

            //Medical Info Section
            'heart_disease' => 'required',
            'heart_surgery' => 'required',
            'heart_attack' => 'required',
            'stroke' => 'required',
            'smoking' => 'required',
            'cancer' => 'required',
            'breathlessness' => 'required',
            'epilepsy' => 'required',
            'chest_pain_discomfort' => 'required',
            'irregular_heartbeat' => 'required',
            'respiratory_problems' => 'required',
            'joint_pain_problems' => 'required',
            'surgery' => 'required',
            'dizziness_fainting' => 'required',
            'high_cholesterol' => 'required',
            'hypertension' => 'required',
            'other' => 'required',
            'hand_details' => 'required_if:handRadio,yes',
            'injury_details' => 'required_if:injuryRadio,yes',
            'meds_details' => 'required_if:medsRadio,yes',
            'heartRadio' => 'required',
            'activityRadio' => 'required',
            'monthRadio' => 'required',
            'consciousnessRadio' => 'required',
            'boneRadio' => 'required',
            'bloodRadio' => 'required',
            'concussedRadio' => 'required',
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
            'accepted' => 'Please confirm that your details are correct'
        ]
    
    );

        // check if subscribe for updates checkbox is checked and subscribe if so
        if($request->input('subscribeCheckbox')){
            Subscriber::subscribe($request->input('first_name') . ' ' . $request->input('last_name'), $request->input('email'));
        }

        if($validator->fails()){

            return redirect()->back()->withErrors($validator);
            session()->flash('error', 'Application could not be processed');
            return redirect()->back();

        }

        // also need to check if someone has already submitted
        // an application for this email address
        if(Applicant::where('email', $request->input('email'))->where('event_id', Event::current()->id)->get()->first() != null){

            session()->flash('error', 'An application has already been submitted using this email address,
            please contact Fight for Kidz if this is an error, or if you wish to amend you application details.');
            return redirect()->back();

        }

        // validator has not failed, so make the applicant record
        $applicant = new Applicant;
        $applicant->first_name = $request->input('first_name');
        $applicant->last_name = $request->input('last_name');
        $applicant->address_1 = $request->input('address_1');
        $applicant->address_2 = $request->input('address_2');
        $applicant->suburb  = $request->input('suburb');
        $applicant->city = $request->input('city');
        $applicant->postcode = $request->input('post_code');
        $applicant->phone = $request->input('phone');
        $applicant->mobile = $request->input('mobile');
        $applicant->email = $request->input('email');
        $applicant->dob = $request->input('dob'); // need to confirm that date is being stored appropriately
        $applicant->height = $request->input('height');
        $applicant->current_weight = $request->input('current_weight');
        $applicant->expected_weight = $request->input('expected_weight') ?? $request->input('current_weight'); // will use current weigt if expected weight is empty
        $applicant->occupation = $request->input('occupation');
        $applicant->employer = $request->input('employer');
        $applicant->is_male = $request->input('gender') == 'male' ? true : false;
        $applicant->right_handed = $request->input('hand') == 'right' ? true : false;
        $applicant->preferred_nickname = $request->input('nickname');
        $applicant->can_secure_sponsor = $request->input('sponsorRadio') == 'yes' ? true : false;
        $applicant->fitness_rating = $request->input('fitness_rating');
        $applicant->boxing_exp = $request->input('fighting_experience');
        $applicant->sporting_exp = $request->input('sporting_experience');
        $applicant->hobbies = $request->input('hobbies');
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

        $applicant->save(); // generates id number to use when generating image name

        $image = $request->file('photo');
        $imagePath = 'private\images\applicants\\';
        $imageName = $applicant->id . '.png'; 
        
        // Convert to png if needed and store
        Image::storeAsPng($image, $imagePath, $imageName);

        if(isset($img)){
            imagepng($img, storage_path('app\\' . $imagePath . $imageName));
        } else{
            // save image to storage
            $image->storeAs($imagePath, $imageName);
        }
        
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
