<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Applicant;
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

    public function downloadExcel(Request $request){
        
    }
}
