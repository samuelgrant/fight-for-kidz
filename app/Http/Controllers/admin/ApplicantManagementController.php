<?php

namespace App\Http\Controllers\admin;

use App\Applicant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ApplicantManagementController extends Controller
{
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
            
            //Input not implemented at this stage
            // if($applicant->contender->is($bout->victor)){
            //     $bout->victor()->dissociate();
            // }

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
    
            $no_team = Applicant::getNonContenders($eventID);
    
            Applicant::downloadCsv($applicants, $red_team, $blue_team, $no_team);
        } catch(Exception $e) {
            session()->flash('error', 'Something went wrong. The spreadsheet cannot be downloaded.');
        }


        return redirect()->back();
    }

    /**
     *  Deletes the applicant/application from the database. This allows the applicant to reapply 
     *  if they misentered information in their initial application. 
     * 
     *  It also allows the admins to remove spam applications and applications that they deem 
     *  inappropriate. 
	 */
	public function deleteApplicant($applicantID){

		$applicant = Applicant::find($applicantID);

		// check that the applicant isn't on a team.
		if(!$applicant->isContender()){

			// delete application and remove image from storage
			$applicant->discard();
			session()->flash('success', $applicant->first_name . ' ' . $applicant->last_name . '\'s application was discarded.');
		} else {
			session()->flash('error', 'Cannot delete this applicant, they are currently in a team. Please remove them and try again.');
		}

		return redirect()->back();
	}
}
