<?php

namespace App;

use Excel;
use Illuminate\Database\Eloquent\Model;
use App\Contender;
use App\Traits\Groupable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class Applicant extends Model
{
    use Groupable;
    
    // Relationship to event - many to one
    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    // Relationship to contender - one to one
    public function contender()
    {
        return $this->hasOne('App\Contender');
    }

    /**
     * Returns true if the applicant has an associated
     * contender record and the contender is assigned to 
     * a team.
     */
    
    public function isContender(){

        if($this->contender != null){
            return $this->contender->team != null;
        }

        return false;
    }

    /**
     *  Returns collection of non contenders
     *  belonging to given event.
     */
    public static function getNonContenders($eventId){

        $nonContenders = new Collection;

        foreach(Applicant::where('event_id', $eventId)->get() as $applicant){
            if($applicant->contender == null){
                $nonContenders->push($applicant);
            } elseif($applicant->contender->team == null){
                $nonContenders->push($applicant);
            }
        }

        return $nonContenders;
    }

    /**
     *  Creates a contender record for this applicant.
     */
    public function addToTeam($team){

        // check whether a contender already exists
        if($this->contender == null){

            $contender = new Contender;
            $contender->applicant_id = $this->id;
            $contender->weight = $this->expected_weight;
            $contender->height = $this->height;
            $contender->first_name = $this->first_name;
            $contender->last_name = $this->last_name;
            $contender->nickname = $this->preferred_nickname;
            $contender->team = $team;
            $contender->event_id = $this->event_id;
            $contender->save();

            // set foreign key field on contender
            $this->contender()->save($contender);

        }
        else { //contender record already exists, change team only

            $contender = $this->contender;
            $contender->team = $team;
            $contender->save();
        }

    }

    /**
     *  Removes the applicants associated contender from whatever
     *  team it is in. The contender record is not deleted from the
     *  database, and any customized data for the contender will remain
     *  intact.
     */
    public function clearTeam(){

        $contender = $this->contender;

        if($contender != null){
            $contender->team = null;
            $contender->save();
        }

    }

    /**
     *  Returns the age of the applicant
     */
    public function getAgeOnEventDate(){
        $date = Carbon::parse($this->dob);
        $eventDate = Carbon::parse($this->event->date);

        return $eventDate->diffInYears($date);
    }

    public function getAge(){
        $date = Carbon::parse($this->dob);

        return Carbon::now()->diffInYears($date);
    }

    /**
     * Returns the applicants team
     * @return Red||Blue||Null
     */
    public function getTeam(){
        if($this->contender != null){
            return $this->contender->team;
        }else {
            return null;
        }
    }

    public static function downloadCsv($applicants, $red_team, $blue_team, $no_team){
        // Remove unnecessary applicant informaiton
        $applicants = Applicant::trimApplicants($applicants);
        $red_team = Applicant::trimApplicants($red_team);
        $blue_team = Applicant::trimApplicants($blue_team);
        $no_team = Applicant::trimApplicants($no_team);

        //Create and download
        Applicant::createExcel($applicants, $red_team, $blue_team, $no_team);
    }

    /**
     * Trims an applicants data to display the information we want, in the format we want
     * @param Elloquent\Applicant
     * @return Elloquent\Applicant
     */
    private static function trimApplicants($applicants){

        for($i = 0; $i < count($applicants); $i++){
            $tmpApplicant = new Applicant();
                //General
                $tmpApplicant->Name = $applicants[$i]->last_name.', '.$applicants[$i]->first_name;
                $tmpApplicant->Fight_name = $applicants[$i]->preferred_fight_name;
                $tmpApplicant->Age = $applicants[$i]->getAge();
                $tmpApplicant->Gender = ($applicants[$i]->is_male)? "Male":"Female";
                $tmpApplicant->DOB = $applicants[$i]->dob;

                $tmpApplicant->Phone_1 = $applicants[$i]->phone_1;
                $tmpApplicant->Phone_2 = $applicants[$i]->phone_2;
                $tmpApplicant->Email = $applicants[$i]->email;

                $tmpApplicant->Address_1 = $applicants[$i]->address_1;
                $tmpApplicant->Address_2 = $applicants[$i]->address_2;
                $tmpApplicant->Suburb = $applicants[$i]->suburb;
                $tmpApplicant->City = $applicants[$i]->city;
                $tmpApplicant->Post_code = $applicants[$i]->postcode;

                //Personal
                $tmpApplicant->Height = $applicants[$i]->height;
                $tmpApplicant->Weight = $applicants[$i]->current_weight;
                $tmpApplicant->Expected_weight = $applicants[$i]->expected_weight;
                $tmpApplicant->Fitness_rating = $applicants[$i]->fitness_rating. " out of 5";
                $tmpApplicant->Dominant_hand = ($applicants[$i]->right_handed) ? "Right" : "Left";

                $tmpApplicant->Boxing_kickboxing_martial_arts_experience = $applicants[$i]->boxing_exp;
                $tmpApplicant->Sporting_experience = $applicants[$i]->sporting_exp;
                $tmpApplicant->Hobbies_interests = $applicants[$i]->hobbies;

                //Emergency
                $tmpApplicant->Emergency_name = $applicants[$i]->emergency_last_name. ', ' .$applicants[$i]->emergency_first_name;
                $tmpApplicant->Relationship = $applicants[$i]->emergency_relationship;
                $tmpApplicant->Emergency_phone_1 = $applicants[$i]->emergency_phone_1;
                $tmpApplicant->Emergency_phone_2 = $applicants[$i]->emergency_phone_2;
                $tmpApplicant->Emergency_email = $applicants[$i]->emergency_email;

                //Medical 1
                $tmpApplicant->Heart_disease = ($applicants[$i]->heart_disease)? "Yes" : "No";
                $tmpApplicant->Breathlessness = ($applicants[$i]->breathlessness)? "Yes" : "No";
                $tmpApplicant->Epilepsy = ($applicants[$i]->epilepsy)? "Yes" : "No";
                $tmpApplicant->Heart_attack = ($applicants[$i]->heart_attack)? "Yes" : "No";
                $tmpApplicant->Stroke = ($applicants[$i]->stroke)? "Yes" : "No";
                $tmpApplicant->Heart_surgery = ($applicants[$i]->heart_surgery)? "Yes" : "No";
                $tmpApplicant->Repiratory = ($applicants[$i]->respiratory_problems)? "Yes" : "No";
                $tmpApplicant->Cancer = ($applicants[$i]->cancer)? "Yes" : "No";
                $tmpApplicant->Irregular_heartbeat = ($applicants[$i]->irregular_heartbeat)? "Yes" : "No";
                $tmpApplicant->Smoking = ($applicants[$i]->smoking)? "Yes" : "No";
                $tmpApplicant->Joint_problems = ($applicants[$i]->joint_pain_problems)? "Yes" : "No";
                $tmpApplicant->Chest_pain = ($applicants[$i]->chest_pain_discomfort)? "Yes" : "No";
                $tmpApplicant->Hypertension = ($applicants[$i]->hypertension)? "Yes" : "No";
                $tmpApplicant->Sugery = ($applicants[$i]->surgery)? "Yes" : "No";
                $tmpApplicant->Dizziness_fainting = ($applicants[$i]->dizziness_fainting)? "Yes" : "No";
                $tmpApplicant->High_cholesterol = ($applicants[$i]->high_cholesterol)? "Yes" : "No";                
                $tmpApplicant->Other = $applicants[$i]->other;

                $tmpApplicant->Medically_supervised_activity = ($applicants[$i]->heart_condition)? "Yes" : "No";
                $tmpApplicant->Chest_pain_brought_on_by_physical_activity = ($applicants[$i]->chest_pain_activity)? "Yes" : "No";
                $tmpApplicant->Onset_of_recent_chest_pain = ($applicants[$i]->chest_pain_recent)? "Yes" : "No";
                $tmpApplicant->Passed_out_due_to_dizziness = ($applicants[$i]->lost_consciousness)? "Yes" : "No";
                $tmpApplicant->Bone_Joint_problems = ($applicants[$i]->bone_joint_problems)? "Yes" : "No";
                $tmpApplicant->Medication_for_blood_pressure_or_heart = ($applicants[$i]->recommended_medication)? "Yes" : "No";

                //Medical 2
                $tmpApplicant->Explain_your_losses_of_consciousness = $applicants[$i]->lost_consciousness;
                $tmpApplicant->Is_there_any_reason_why_you_shouldnt_participate = $applicants[$i]->other_reasons;
                $tmpApplicant->Hand_injuries = $applicants[$i]->hand_injuries;
                $tmpApplicant->Previous_significant_injuries = $applicants[$i]->previous_current_injuries;
                $tmpApplicant->Current_medication = $applicants[$i]->current_medication;

                //Additional
                $tmpApplicant->Occupation = $applicants[$i]->occupation;
                $tmpApplicant->Employer = $applicants[$i]->employer ;
                $tmpApplicant->Can_secure_sponsor = ($applicants[$i]->can_secure_sponsor)? "Yes" : "No";
                $tmpApplicant->Consents_to_drug_test = ($applicants[$i]->consent_to_test)? "Yes" : "No";
                $tmpApplicant->Has_conviction = $applicants[$i]->conviction_details;

                //Custom
                $tmpApplicant->Custom_1 = $applicants[$i]->custom_one;
                $tmpApplicant->Custom_2 = $applicants[$i]->custom_two;
                $tmpApplicant->Custom_3 = $applicants[$i]->custom_three;
                $tmpApplicant->Custom_4 = $applicants[$i]->custom_four ;
                $tmpApplicant->Custom_5 = $applicants[$i]->custom_five;
                
            $applicants[$i] = $tmpApplicant;
        }

        return $applicants;
    }
    
    /**
     * Creates and downloads the CSV file
     * @param Class\Teams
     * @return File\Applicants.csv
     */
    private static function createExcel($applicants, $red_team, $blue_team, $no_team){
        
        $all = $applicants->toArray();
        $red =  $red_team->toArray();
        $blue = $blue_team->toArray();
        $none = $no_team->toArray();
     
        return Excel::create('Fighter Applications', function($excel) use ($all, $red, $blue, $none) {
			$excel->sheet('All Fighters', function($sheet) use ($all)
	        {
				$sheet->fromArray($all);
            });
            
            $excel->sheet('Red Team', function($sheet) use ($red)
	        {
				$sheet->fromArray($red);
            });
            
            $excel->sheet('Blue Team', function($sheet) use ($blue)
	        {
				$sheet->fromArray($blue);
            });
            
            $excel->sheet('No Team', function($sheet) use ($none)
	        {
				$sheet->fromArray($none);
	        });
		})->download('xlsx');
    }

    /**
     *  Deletes self and removes applicant image from storage
     */
    public function discard(){

        // delete associated applicant image
        Storage::delete('/private/images/applicants/' . $this->id . '.png');

        // delete database record
        $this->delete();
    }
}