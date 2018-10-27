<?php

namespace App\Http\Controllers\admin;

use App\Contender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sponsor;

class ContenderManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.activeUser');
    }

    public function getContender($id){
        
        $contender = Contender::find($id);
        if(isset($contender)){
            return response($contender, 200);
        }
        
        return response("No contender found", 400);
    }

    public function update($contenderID, Request $request){

        $contender = Contender::find($contenderID);
        $sponsor = Sponsor::find($request->input('contenderSponsor'));

        // validate input here
        //
        //

        $contender->nickname = $request->input('contenderNickname');
        $contender->sponsor()->associate($sponsor);
        $contender->height = $request->input('contenderHeight');
        $contender->weight = $request->input('contenderWeight');
        $contender->reach = $request->input('contenderReach');
        $contender->bio_url = $request->input('contenderBioUrl');
        $contender->bio_text = $request->input('contenderBio');

        $contender->save();

        session()->flash('success', 'Profile of ' . $contender->getFullName() . ' updated.');
        return redirect()->back();

    }
}
