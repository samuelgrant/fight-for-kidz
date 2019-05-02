<?php

namespace App\Http\Controllers\admin;

use Storage;
use Illuminate\Support\Facades\Log;
use App\Group;
use App\Event;
use App\User;
use App\Sponsor;
use App\Contact;
use App\Applicant;
use App\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupManagementController extends Controller
{
    /**
     * Displays the usermanagement view.
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
        $allGroups = Group::all(); // excluding trashed
        $group = Group::withTrashed()->find($id);
        $groupMembers = $group->recipients();
        return view('admin.groupManagement')
            ->with('group', $group)
            ->with('members', $groupMembers)
            ->with('groups', $allGroups);
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
        
        if(Group::where('name', $request->input('groupName'))->first()){

            session()->flash('error', 'A group with this name already exists.');            

        } else if(Group::withTrashed()->where('name', $request->input('groupName'))->first()){

            session()->flash('error', 'A group with this name already exists, but has been disabled. Please restore and use that one.');

        } else{

            $group = new Group();
            $group->name = $request->input('groupName');
            $group->save(); // save now to generate id
            $group->setImage(($request->file('groupImage')!== null)? $request->file('groupImage') : null);    
         
            session()->flash('success', 'Group created successfully');
        }

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
        $contact = Contact::where('email', $request->input('email'))->first();
        
        if(empty($contact)){
            $contact = new Contact();
                $contact->name = $request->input('name');
                $contact->email = $request->input('email');
                $contact->phone = $request->input('phone');
                $contact->role = 'Custom Contact';
            $contact->save();
        }
        // Check if the user is trying to make a new contact using an email already in use.
        elseif($contact->name != $request->input('name')){            
            session()->flash('error', 'The email address "'.$request->input('email').'" is already assigned to '.$contact->name.' in '.count($contact->groups).' group(s)');
            return redirect()->back();
        }

        // We have loaded the contact with this email address and checked that the same name is 
        // being used. Now we can add to the group.
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
    public function removeMember($groupID, $email){
        Group::find($groupID)->removeMembersByEmail($email);
    }

    /**
     * Adds an exisiting groupable object to a new group.
     * 
     * Firstly, it retrieves the object for the member, which can
     * be applicant, subscriber, sponsor, user (admin) or contact.
     * 
     * Each of the above objects has the 'groupable' trait, and
     * therefore has the 'addToGroup' method. This method is used
     * to add the object to the selected group.
     * 
     */
    public function addMemberToAnotherGroup($groupId, $memberType, $memberId){

        $groupable;

        if($memberType == "subscriber"){
            $groupable = Subscriber::find($memberId);
        }
        elseif($memberType == "sponsor"){
            $groupable = Sponsor::find($memberId);
        }
        elseif($memberType == "applicant"){
            $groupable = Applicant::find($memberId);
        }
        elseif($memberType == "admin"){
            $groupable = User::find($memberId);
        }
        else{ // member is a 'contact' object
            $groupable = Contact::find($memberId);
        }

        $groupable->addToGroup($groupId);

        Log::debug('Use the copy function to add '. $memberType . ' ' . $memberId . ' to group ' . $groupId);
    }


    // REVAMPED GROUP SYSTEM

    /**
     *  Returns view of all contacts
     */
    public function getAll(){

        return view('admin.systemGroupManagement')->with('type', 'All')->with('groups', Group::all());

    }

    /**
     *  Returns view of all admins
     */
    public function getAdmins(){

        return view('admin.systemGroupManagement')->with('type', 'Admins')->with('groups', Group::all());

    }

    /**
     *  Returns view of all subscribers
     */
    public function getSubscribers(){

        return view('admin.systemGroupManagement')->with('type', 'Subscribers')->with('groups', Group::all());

    }

    /**
     *  Returns view of all applicants
     */
    public function getAllApplicants(){

        return view('admin.systemGroupManagement')->with('type', 'All Applicants')->with('groups', Group::all());

    }

    /**
     * Returns view of all applicants from current event
     */
    public function getApplicants($eventId){
        
        return view('admin.systemGroupManagement')->with('type', 'Applicants')->with('groups', Group::all())
                                                    ->with('event', Event::find($eventId));;
    }

    /**
     *  Returns view of all sponsors
     */
    public function getAllSponsors(){

        return view('admin.systemGroupManagement')->with('type', 'All Sponsors')->with('groups', Group::all());

    }

    /**
     * Returns view of all sponsors from current event
     */
    public function getSponsors($eventId){
        return view('admin.systemGroupManagement')->with('type', 'Sponsors')->with('groups', Group::all())
                                                    ->with('event', Event::find($eventId));;
    }

    /**
     * Returns view of all other contacts 
     */
    public function getOthers(){

        return view('admin.systemGroupManagement')->with('type', 'Others')->with('groups', Group::all());

    }

    /**
     * Returns view of red team for current event
     */
    public function getRed($eventId){
        return view('admin.systemGroupManagement')->with('type', 'Red Contenders')->with('groups', Group::all())
                                                    ->with('event', Event::find($eventId));
    }

    /**
     * Returns view of blue team for current event
     */
    public function getBlue($eventId){
        return view('admin.systemGroupManagement')->with('type', 'Blue Contenders')->with('groups', Group::all())
                                                    ->with('event', Event::find($eventId));;
    }

    /**
     * Returns contact as JSON 
     */
    public function getContact($contactID){

        $contact = Contact::find($contactID);
        return [
            'name' => $contact->name,
            'phone' => $contact->phone,
            'email' => $contact->email
        ];

    }

    /**
     * Updates a contact record 
     */
    public function updateContact(Request $request, $contactID){        

        // Validate form input
        $this->validate($request, [
            'name' => 'string|required',
            'email' => 'email|required',
        ]);

        // Make sure no other contacts have the same email
        if(count(Contact::where('email', $request->input('email'))->get()) > 0){
            session()->flash('error', 'Unable to update contact as there is already a contact with this email address.');
            return redirect()->back();
        }

        // Ensure that the contact to update exists
        $contact = Contact::find($contactID);
        if($contact)
        {
            // Update contact information
            $contact->name = $request->input('name');
            $contact->phone = $request->input('phone');
            $contact->email = $request->input('email');
            $contact->save();

            session()->flash('success', 'Contact updated successfully');
        }else
        {            
            session()->flash('error', 'There was an error updating this contact.');
        }

        return redirect()->back();
    }

    /**
     * Deletes a contact permanently.
     */
    public function deleteContact($contactID){
        $contact = Contact::find($contactID);

        if($contact){
            
            // first need to remove contact from all groups
            foreach($contact->groups as $group){
                $contact->removeFromGroup($group->id);
            }

            // then delete contact itself
            $contact->delete();

            session()->flash('success', 'Contact deleted successfully');

            return redirect()->back();
        }
    }

}
