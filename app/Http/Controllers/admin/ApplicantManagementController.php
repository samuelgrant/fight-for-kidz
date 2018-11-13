<?php

namespace App\Http\Controllers\admin;

use App\Applicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class ApplicantManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.activeUser');
    }

    /*
     * 
     */
    public function getApplicant($id){
        $applicant = Applicant::find($id);
        if(isset($applicant)){
            return response($applicant, 200);
        }
        
        return response("No applicant found", 400);
    }
    
    public function addToTeam(Request $request){

        $applicant = Applicant::find($request->input('applicantId'));
        $applicant->addToTeam($request->input('team'));

    }

    public function removeFromTeam(Request $request){

        $applicant = Applicant::find($request->input('applicantId'));
        $applicant->clearTeam();

        // contender record retained in case they are re-added. We don't want to
        // lose the contender information. This will likely cause issues with
        // the event contender count.

        // remove this applicants contender from any bouts they were in,
        // whether red, blue or victor
        foreach($applicant->contender->bouts() as $bout){

            if($applicant->contender->is($bout->red_contender)){
                $bout->red_contender()->dissociate();
            }

            if($applicant->contender->is($bout->blue_contender)){
                $bout->blue_contender()->dissociate();
            }
            
            if($applicant->contender->is($bout->victor)){
                $bout->victor()->dissociate();
            }

            $bout->save();
        }

    }

    /**
     * Creates and downloads an excel spreadsheet of applicants
     * @param EventID
     * @return ExcellObject || @return error && @return Request
     */
    public function downloadExcel(Request $request, $eventID){

        try {
            $applicants = Applicant::where('event_id', $eventID)->orderBy('last_name')->get();
        
            $red_team = Applicant::where('event_id', $eventID)->whereHas('contender', function($q) {
                $q->where('team', '=', 'red');
            })->orderBy('last_name')->get();
    
            $blue_team = Applicant::where('event_id', $eventID)->whereHas('contender', function($q) {
                $q->where('team', '=', 'blue');
            })->orderBy('last_name')->get();
    
            $no_team = Applicant::where('event_id', $eventID)->whereHas('contender', function($q) {
                $q->where('team', '=', null);
            })->orderBy('last_name')->get();
    
            Applicant::downloadCsv($applicants, $red_team, $blue_team, $no_team);
        } catch(Exception $e) {
            session()->flash('error', 'Something went wrong. The spreadsheet cannot be downloaded.');
        }


        return redirect()->back();
    }
}
