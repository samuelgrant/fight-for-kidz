<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.activeUser');
    }

    public function index(){
        return view('admin.mail');
    } 
}
