<?php

namespace App;

use Excel;
use App\Applicant;
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
     * Trims an applicants data to the information we want
     * @param Elloquent\Applicant
     * @return Elloquent\Applicant
     */
    private static function trimApplicants($applicants){

        for($i = 0; $i < count($applicants); $i++){
            $tmpApplicant = new Applicant();
                $tmpApplicant->name = $applicants[$i]->last_name.', '.$applicants[$i]->first_name;
                $tmpApplicant->pref_name = $applicants[$i]->preferred_nickname;
                $tmpApplicant->gender = ($applicants[$i]->is_male)? "Male":"Female";
                $tmpApplicant->age = $applicants[$i]->getAge().', '.$applicants[$i]->dob;
                $tmpApplicant->phone = (isset($applicants[$i]->mobile))? $applicants[$i]->mobile : $applicants[$i]->phone;
                $tmpApplicant->email = $applicants[$i]->email;
                $tmpApplicant->weight = $applicants[$i]->current_weight;
                $tmpApplicant->height = $applicants[$i]->height;
                $tmpApplicant->dominant_hand = ($applicants[$i]->right_handed) ? "Right" : "Left";
                $tmpApplicant->has_conviction = isset($applicants[$i]->conviction_details);
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