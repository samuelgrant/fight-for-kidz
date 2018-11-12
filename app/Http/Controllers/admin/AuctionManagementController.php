<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Auction;

class AuctionManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.activeUser');
    }

    public function getAuctionItems(){
        $auctionItems = Auction::all();

        return response($auctionItems, 200);
    }
}
