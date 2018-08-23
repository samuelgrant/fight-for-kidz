<?php

namespace App\Http\Controllers\admin;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserManagementController extends Controller
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
        $user = User::orderBy('name', 'asc')->get();
        return view('admin.userManagement')->with('users', $user);
    }

    /**
     * Updates selected user activation state
     * 
     * @param $id
     */
    public function update($id)
    {
        $user = User::find($id);

        if(Auth::user()->id != $id){
            if($user->active)
            {
                $user->disable();
            }
            else
            {
                $user->enable();
            }
        }
        return redirect()->back();
    }

    /**
     * Soft deletes selected user account
     * 
     * @param $id
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if(Auth::user()->id != $id){
            $user->delete();
        }
        
        return redirect()->back();
    }
}
