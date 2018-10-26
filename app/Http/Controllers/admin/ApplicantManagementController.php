<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Applicant;
use App\Http\Controllers\Controller;

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

    }
}
