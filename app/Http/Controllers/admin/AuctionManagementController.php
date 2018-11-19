<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AuctionItem;
use App\Image;

class AuctionManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.activeUser');
    }

    /**
     * finds and returns auction item
     * 
     * @param id
     */
    public function getAuctionItem($id){
        $item = AuctionItem::find($id);
        if(isset($item)){
            return response($item, 200);
        }
        
        return response("No item found", 400);
    }
    
    /**
     * Creates a new auction item
     * 
     * @param request
     */
    public function store(request $request){

        $this->validate($request,[
            'name' => 'string|required',
            'description' => 'string|required|lte:150',
            'donor' => 'string|required',
            'donorUrl' => 'string',
            'itemImage' => 'mimes:jpg,jpeg,png|max:2000'
        ]);

        $item = new AuctionItem();
            $item->name = $request->input('name');
            $item->desc = $request->input('description');
            $item->donor = $request->input('donor');
            $item->donor_url = $request->input('donorUrl');
        $item->save();

        $image = $request->file('itemImage');

        Image::storeAsPng($image, '/public/images/auction/', $item->id . '.png');

        session()->flash('success', 'The item called '.$item->name.' was created.');
        return redirect()->back();
    }

    /**
     *  Updates auctionItem
     */
    public function update(Request $request, $itemId){
        
        $this->validate($request,[
            'name' => 'string|required',
            'description' => 'string|required|lte:150',
            'donor' => 'string|required',
            'donorUrl' => 'string',
            'itemImage' => 'mimes:jpg,jpeg,png|max:2000'
        ]);


        $item = AuctionItem::find($itemId);

        $item->name = $request->input('name');
        $item->desc = $request->input('description');
        $item->donor = $request->input('donor');
        $item->donor_url = $request->input('donorUrl');
                
        // Update image if a file was uploaded
        if($image = $request->file('itemImage')){
            Image::storeAsPng($image, '/public/images/auction/', $item->id . '.png');
        }

        $item->save();

        session()->flash('success', $item->name . ' was updated.');

        return redirect()->back();
    }


    /**
     * Soft deletes selected auction item
     * 
     * @param $id
     */
    public function destroy($id)
    {
        $item = AuctionItem::find($id);
        $item->delete();
        session()->flash('success', 'The auction item '.$item->name.' was deleted.'); 
        
        return redirect()->back();
    }

    /**
     * Restores selected soft deleted auction item
     * 
     * @param $id
     */
    public function restore($id){

        $item = AuctionItem::withTrashed()->find($id);
        $item->restore();
        session()->flash('success', 'The auction item '.$item->name.' was restored');

        return redirect()->back();
    }
}
