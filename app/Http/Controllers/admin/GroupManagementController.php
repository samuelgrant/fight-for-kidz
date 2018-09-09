<?php

namespace App\Http\Controllers\admin;

//use Validator;
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
            $group->image = $group->id.".png";
        }
        $deletedGroups = Group::onlyTrashed()->get();
        return view('admin.groupsManagement')->with(['groups' => $groups, 'deletedGroups' => $deletedGroups]);
    }

    public function view($id)
    {
        $group = Group::withTrashed()->find($id);
        $groupMembers = $group->recipients();
        return view('admin.groupManagement')
            ->with('group', $group)
            ->with('members', $groupMembers);
    }

    public function store(Request $request){
        $this->validate($request, [
            'groupName' => 'required|string',
            'groupImage' => 'mimes:png|dimensions:min_width=80,min_height=100'
        ]);
        
        
        $group = new Group();
            $group->name = $request->input('groupName');
            $group->setImage(($request->file('groupImage')!== null)? $request->file('groupImage') : null); 
        $group->save();

        return redirect()->back();
    }

    /**
     * Updates a group name and avatar
     * 
     * @param request, $id
     */
    public function update(request $request, $id){
        $this->validate($request, [
            'groupName' => 'required|string',
            'groupImage' => 'mimes:png|dimensions:min_width=80,min_height=100'
        ]);
        
        $group = Group::find($id);
            $group->name = $request->input('name');
            $group->setImage($request->file('groupImage')!== null)? $request->file('groupImage') : null;
        $group->save();

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
