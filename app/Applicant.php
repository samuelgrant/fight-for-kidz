<?php

namespace App;

use Maatwebsite\Excel\Excel;
use App\Applicant;
use Illuminate\Database\Eloquent\Model;
use App\Contender;
use App\Traits\Groupable;
use Carbon\Carbon;

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
     *  Creates a contender record for this applicant.
     */
    public function addToTeam($team){

        // check whether a contender already exists
        if($this->contender == null){

            $contender = new Contender;
            $contender->applicant_id = $this->id;
            $contender->weight = $this->expected_weight;
            $contender->height = $this->height;
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

    public static function downloadCsv($applicants){
        // Split the applicants into teams.
        $teams = Applicant::getTeams($applicants);

        // Remove unnecessary applicant informaiton
        $applicants = Applicant::trimApplicants($applicants);
        $teams->red = Applicant::trimApplicants($teams->red);
        $teams->red = Applicant::trimApplicants($teams->blue);
        $teams->red = Applicant::trimApplicants($teams->none);


        //Create and download
        Applicant::createExcel($applicants, $teams);
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
                $tmpApplicant->height = $applicants[$i]->current_height;
                $tmpApplicant->dominant_hand = ($applicants[$i]->right_handed) ? "Right" : "Left";
                $tmpApplicant->has_conviction = isset($applicants[$i]->conviction_details);
            $applicants[$i] = $tmpApplicant;
        }

        return $applicants;
    }

    /**
     * Breaks down applicants into teams
     * @param Elloquent\Applicants
     * @return Class\Teams
     */
    private static function getTeams($applicants){
        $teams = new class{};
        $redTeam = [];
        $blueTeam = [];
        $noTeam = [];

        foreach($applicants as $applicant){
            if($applicant->getTeam() == "red"){
                array_push($redTeam, $applicant);
            } elseif ($applicant->getTeam() == "blue"){
                array_push($blueTeam, $applicant);
            } else {
                array_push($noTeam, $applicant);
            }
        }

        $teams->red = $redTeam;
        $teams->blue = $blueTeam;
        $teams->none = $noTeam;

        return $teams;
    }

    /**
     * Creates and downloads the CSV file
     * @param Class\Teams
     * @return File\Applicants.csv
     */
    private static function createExcel($applicants, $teams){
        // Excel::create('Applicants', function($excel) {
        //     // Set the title
        //     $excel->setTitle('Applications');

        //     // Chain the setters
        //     $excel->setCreator('Fight for Kidz System')->setCompany('Fight for Kidz');

        //     //Creatte applicant sheet
        //     $excel->sheet('All Applicants', function($sheet) use ($applicants) {
        //         $sheet->setOrientation('landscape');
        //         $sheet->fromArray($applicants, null, 'A3');
        //     })->download('xlsx');
        // });
    }
}