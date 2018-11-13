<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteSettingsController extends Controller
{
    // Update settings
    public function update(Request $request){

        

        session()->flash('success', 'Site settings updated successfully');

        return redirect()->back();

    }
}
