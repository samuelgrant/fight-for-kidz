<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class ImageController extends Controller
{
    /**
     * Returns an applicant image from private storage, if the user is
     * logged in.
     * 
     * Returns the 'noImage' image if the requested image does not exist.
     * 
     * https://laravel.io/forum/04-23-2015-securing-filesimages
     */
    public function getApplicantImage($filename){

        $fullpath = "/private/images/applicants/" . $filename;

        if(Storage::exists($fullpath)){       
            return response()->download(storage_path("app/" . $fullpath), null, [], null);
        } else{
            return response()->download(storage_path("app/public/images/noImage.png"));
        }
    }
}
