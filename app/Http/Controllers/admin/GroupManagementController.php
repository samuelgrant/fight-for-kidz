<?php

namespace App\Http\Controllers\admin;

use Storage;
use App\Group;
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
        $groups = Group::all();
        foreach($groups as $group){
            $group->image = $group->id.".ping";
        }
        $deletedGroups = Group::onlyTrashed()->get();
        return view('admin.groupsManagement')->with(['groups' => $groups, 'deletedGroups' => $deletedGroups]);
    }

    public function view($id)
    {
        return view('admin.groupManagement')
            ->with('group', Group::withTrashed()->find($id));
    }

    public function store(Request $request){
        $group = new Group();
        $group->name = $request->input('groupName');

        $group->save(); // need to save group here to generate an ID value
        
        if($request->hasFile('groupImage')){
            
            // Validate image dimensions and file type. Resize would be great if too large.
            
            // Saves file as a png with the filename equal to the group id.
            $request->file('groupImage')->storeAs('public/images/groups', $group->id.'.png');

            // Set the group to use custom icon. Defaults to false.
            $group->custom_icon = true;
            $group->save();
        }        
        
        return redirect()->back();
    }

    /**
     * Soft deletes selected group
     * 
     * @param $id
     */
    public function destroy($id){
        
        $group = Group::find($id);
        if($group->type != "System Group"){
            $group->delete();
            session()->flash('success', 'The group '.$group->name.' was disabled.');
        } else {
            session()->flash('error', 'You cannot disable that group.');
        }
        
        
        return redirect(route('admin.groupManagement'));
    }

    /**
     * Restores soft deleted selected group then navigates back to Group Management
     * 
     * @param $id
     */
    public function restore($id){

        $group = Group::withTrashed()->find($id);
        $group->restore();
        session()->flash('success', 'The group called '.$group->name.' was restored.');

        return redirect()->back();
    }
}
