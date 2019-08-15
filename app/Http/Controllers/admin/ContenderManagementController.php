<?php

namespace App\Http\Controllers\admin;

use App\Contender;
use Validator;
use Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sponsor;
use App\Image;

class ContenderManagementController extends Controller
{
    public function getContender($id){
        
        $contender = Contender::find($id);
        if(isset($contender)){
            return [
                'first_name' => $contender->first_name,
                'last_name' => $contender->last_name,
                'nickname' => $contender->nickname,
                'sponsor_id' => $contender->sponsor_id,
                'height' => $contender->height,
                'weight' => $contender->weight,
                'reach' => $contender->reach,
                'donate_url' => $contender->donate_url,
                'bio_text' => $contender->bio_text,
                'bio_url' => $contender->bio_url
            ];
        }
        
        return response("No contender found", 400);
    }

    public function update($contenderID, Request $request){

        $contender = Contender::find($contenderID);
        $sponsor = Sponsor::find($request->input('contenderSponsor'));
        $image = $request->file('contenderImage');

        $validator = Validator::make(Input::all(), [ 
            // need to add the rest here
            'contenderDonateUrl' => 'nullable|active_url',
            'contenderImage' => 'image|mimes:jpeg,png'
            ],        
            // error messages
            [
                'required' => ':attribute must be filled in',
                'url' => 'Please enter a valid URL'
            ]
    
        )->validate();
                

        $contender->nickname = $request->input('contenderNickname');
        $contender->first_name = $request->input('contenderFirstName');
        $contender->last_name = $request->input('contenderLastName');
        $contender->sponsor()->associate($sponsor);
        $contender->height = $request->input('contenderHeight');
        $contender->weight = $request->input('contenderWeight');
        $contender->reach = $request->input('contenderReach');
        $contender->bio_url = $request->input('contenderBioUrl');
        $contender->bio_text = $request->input('contenderBio');
        $contender->donate_url = $request->input('contenderDonateUrl');

        $contender->save();

        if($image){
            // Save image file
            $image = $request->file('contenderImage');
            $imagePath = 'public/images/contenders/';
            $imageName = $contender->id . '.jpg';             
        
            // Convert to png if needed and store
            Image::storeAsJpg($image, $imagePath, $imageName);
        }

        session()->flash('success', 'Profile of ' . $contender->getFullName() . ' updated.');
        return redirect()->back();

    }

    /**
     * Allows the admin team to specify an override bout colour for a contender on the events page
     * 
     * While any value can be set, I only have CSS for the following options:
     * @var coloroverride "red", "blue", "white" or "null"
     * @param $id, Illuminate\Http\Request
     */
    public function overrideColor($contenderID, Request $request){
        $contender = Contender::find($contenderID);

        if($contender->coloroverride == null) {
            $contender->coloroverride = "white";
            session()->flash('success', $contender->getFullName() . 's display colour has been set to '.$contender->coloroverride.'.');
        } else {
            $contender->coloroverride = null;
            session()->flash('success', $contender->getFullName() . 's display colour has been set to '.$contender->team.'.');
        }

        $contender->save();
        return redirect()->back();
    }
}
