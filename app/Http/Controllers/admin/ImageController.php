<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.activeUser');
    }

    /**
     * Returns an applicant image from private storage, if the user is
     * logged in.
     * 
     * https://laravel.io/forum/04-23-2015-securing-filesimages
     */
    public function getApplicantImage($filename){

        $fullpath = "app/private/images/applicants/{$filename}";
        
        return response()->download(storage_path($fullpath), null, [], null);
    }
}
