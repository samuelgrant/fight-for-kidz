<?php

namespace App\Http\Controllers;

use Input;
use App\Applicant, App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class EventApplicationController extends Controller
{
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
            'dob' => 'required|date', // string must be date according to PHP strtotime() function
            'height' => 'required|integer|gt:0',
            'current_weight' => 'required|integer|gt:0', 
            'expected_weight' => 'integer|gt:0',
            'occupation' => 'required',
            'employer' => 'required_with:occupation', // employer required if occupation not blank
            'gender' => 'required',
            'hand' => 'required',
            // nickname not required
            'sponsorRadio' => 'required',
            'photo' => 'required|image|mimes:jpeg,png', // accepts jpeg and png - this may not be correct
            'expRadio' => 'required',
            'fighting_experience' => 'required_if:expRadio,yes',
            'sporting_experience' => 'required',
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

        if($validator->fails()){

            return redirect()->back()->withErrors($validator);
            session()->flash('error', 'Application could not be processed');
            return redirect()->back();

        }

        // also need to check if someone has already submitted
        // an application for this email address
        if(Applicant::where('email', $request->input('email'))->get()->first() != null){

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
        $applicant->boxing_exp = $request->input('fighting_experience');
        $applicant->sporting_exp = $request->input('sporting_experience');
        $applicant->conviction_details = $request->input('conviction_details');
        $applicant->consent_to_test = $request->input('drugRadio') == 'yes' ? true : false;

        // set applicant event to current event
        $applicant->event()->associate(Event::current());

        $applicant->save(); // generates id number to use with saving image

        Log::debug('saved applicant');

        $image = $request->file('photo');
        $imageName = $applicant->id . '.png';
        
        // convert to png if not already
        switch (exif_imagetype($image)){

            case IMAGETYPE_PNG:
                break; // don't need to do anything, already a PNG
            case IMAGETYPE_JPEG:
                $img = imagecreatefromjpeg($image);
                break;
            default :
                throw new InvalidArgumentException('Invalid image type'); // validation should prevent this happening
        }

        if(isset($img)){
            $image = imagepng($img);
        }

        // save image to storage
        $image->storeAs('private/images/applicant_photos', $imageName);
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
