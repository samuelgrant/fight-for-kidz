<?php

namespace App\Http\Controllers\admin;

use Storage;
use App\Groups;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.activeUser');
    }

    /**
     * Displays the usermanagment view.
     * 
     * @return $users, view 
     */
    public function index()
    {
        $groups = Groups::all();
        foreach($groups as $group){
            $group->image = $group->id.".ping";
        }
        return view('admin.groupsManagement')->with('groups', $groups);
    }

    public function view($id)
    {
        return view('admin.groupManagement')
            ->with('group', Groups::find($id));
    }

    public function store(Request $request){
        $group = new Groups();
        $group->name = $request->input('groupName');
        
        if($request->hasFile('image')){


        } else {
            $group->custom_icon = false;
        }

        $group->save();
        
        return redirect()->back();
    }

    public function destroy($id){
        
        $group = Group::find($id);
        if($group->type != "System Group"){
            $group->delete();
            session()->flash('success', 'The group '.$group->name.' was disabled.');
        } else {
            session()->flash('error', 'You cannot disable that group.');
        }
        
        return redirect()->back();
    }
}
