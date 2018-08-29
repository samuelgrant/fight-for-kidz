<?php

namespace App\Http\Controllers\admin;

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
        return view('admin.groupManagement')->with('groups', $groups);
    }

    public function view($id)
    {
        return "Group Page: ".$id;
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
