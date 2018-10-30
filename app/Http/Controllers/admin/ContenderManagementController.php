<?php

namespace App\Http\Controllers\admin;

use App\Contender;
use Validator;
use Input;
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
        $image = $request->file('contenderImage');

        $validator = Validator::make(Input::all(), [ 
            // need to add the rest here
            'contenderDonateUrl' => 'active_url',
            ],        
            // error messages
            [
                'required' => ':attribute must be filled in',
                'url' => 'Please enter a valid URL'
            ]
    
        )->validate();
                

        $contender->nickname = $request->input('contenderNickname');
        $contender->sponsor()->associate($sponsor);
        $contender->height = $request->input('contenderHeight');
        $contender->weight = $request->input('contenderWeight');
        $contender->reach = $request->input('contenderReach');
        $contender->bio_url = $request->input('contenderBioUrl');
        $contender->bio_text = $request->input('contenderBio');
        $contender->donate_url = $request->input('contenderDonateUrl');

        $contender->save();

        // store image
        if($image){
            $image->storeAs('/public/images/contenders/', $contender->id . '.png');
        }

        session()->flash('success', 'Profile of ' . $contender->getFullName() . ' updated.');
        return redirect()->back();

    }
}
