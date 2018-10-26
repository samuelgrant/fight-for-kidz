<?php

namespace App\Http\Controllers\admin;

use App\Contender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContenderManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.activeUser');
    }

    public function update($contenderID, Request $request){

        $contender = Contender::find($contenderID);

        // validate input here

        

    }
}
