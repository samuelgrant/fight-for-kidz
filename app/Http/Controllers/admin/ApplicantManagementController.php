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
}
