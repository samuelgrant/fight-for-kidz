<?php

namespace App\Http\Controllers\admin;

//use Validator;
use Storage;
use App\Group;
use App\Contact;
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

    /**
     * Returns a view for a single group.
     * 
     * @param GroupID
     */
    public function view($id)
    {
        $group = Group::withTrashed()->find($id);
        $groupMembers = $group->recipients();
        return view('admin.groupManagement')
            ->with('group', $group)
            ->with('members', $groupMembers);
    }

    /**
     * Creates a new group
     * 
     * @param request(Web Form)
     */
    public function store(Request $request){
        $this->validate($request, [
            'groupName' => 'required|string',
            'groupImage' => 'mimes:png|dimensions:min_width=80,min_height=100'
        ]);
        
        
        $group = new Group();
            $group->name = $request->input('groupName');
            $group->save(); // save now to generate id
            $group->setImage(($request->file('groupImage')!== null)? $request->file('groupImage') : null);         

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
        
        $image = $request->file('groupImage');

        $group = Group::find($id);
            $group->name = $request->input('groupName');

            /* If image file has been set this means the use has selected a new image, 
            *  so set this as the new image. Otherwise, set image to null only if the 
            *  user has clicked 'remove image', which sets the checkbox to true through
            *  javascript.            
            */ 
            if($image){
                $group->setImage($image);
            }
            elseif($request->input('removeImageCheckbox') == true){
                $group->setImage(null);
            }

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

    /**
     * Manually adds a contact to a specific group
     * 
     * @param GroupID, Name, Email
     * @return null
     */
    public function addMember(request $request, $groupID){
        $contact = Contact::where('name', $request->input('name'))
                    ->where('email', $request->input('email'))->first();
        
        if(empty($contact)){
            $contact = new Contact();
                $contact->name = $request->input('name');
                $contact->email = $request->input('email');
                $contact->role = 'Custom Contact';
            $contact->save();
        }

        $contact->addToGroup($groupID);

        session()->flash('success', $request->input('name').' was added to the group.');
        return redirect()->back();
    }

    /**
     * Manually removes a contact from a specific group
     * 
     * @param GroupID, ContactID
     * @return null
     */
    public function deleteMember($groupID, $contactID){
        abort(501);
    }
}
