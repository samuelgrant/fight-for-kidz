<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MerchandiseController extends Controller
{
    public function __construct()
    {
        $this->middleware('merchandise');
    }

    public function Merchandise(){
        return view('Merchandise');
    }

}
