<?php

namespace App\Http\Controllers\admin;

use App\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteSettingsController extends Controller
{
    // Update settings
    public function update(Request $request){

        
        $this->validate($request, [
            'aboutUs' => 'required|string|max:1000',
            'mainPagePhoto' => 'mimes:jpg,jpeg|max:2000',
        ]);

        $settings = SiteSetting::getSettings();

        $settings->about_us = $request->input('aboutUs');
        $settings->display_merch = $request->input('displayMerch') ? true : false;        
        $settings->setMainPhoto($request->file('mainPagePhoto'));
        $settings->save();


        session()->flash('success', 'Site settings updated successfully');

        return redirect()->back();

    }
}
