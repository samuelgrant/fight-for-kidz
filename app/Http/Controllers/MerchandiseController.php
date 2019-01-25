<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MerchandiseItem;

class MerchandiseController extends Controller
{
    public function __construct()
    {
        $this->middleware('merchandise');
    }

    public function index(){
        $merch = MerchandiseItem::all();
        return view('merchandise')->with('merch', $merch);
    }

}
