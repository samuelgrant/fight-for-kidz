<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MerchandiseItem;
use App\Image;

class MerchandiseManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.activeUser');
    }

    /**
     * Displays the merchandiseManagment view.
     * 
     * @return view 
     */
    public function index()
    {
        $merch = MerchandiseItem::orderBy('name', 'asc')->get();
        $deletedMerch = MerchandiseItem::onlyTrashed()->get();
        return view('admin.merchandiseManagement')->with(['merch' => $merch, 'deletedMerch' => $deletedMerch]);
    }

    /**
     * finds and returns an merchandise item
     * 
     * @param id
     */
    public function getMerchandiseItem($id){
        $item = MerchandiseItem::find($id);
        if(isset($item)){
            return response($item, 200);
        }
        
        return response("No item found", 400);
    }
    
    /**
     * Creates a new merchandise item
     * 
     * @param request
     */
    public function store(request $request){

        $this->validate($request,[
            'name' => 'string|required',
            'description' => 'string|required|max:300',
            'itemImage' => 'mimes:jpg,jpeg,png|max:2000'
        ]);

        $item = new MerchandiseItem();
            $item->name = $request->input('name');
            $item->desc = $request->input('description');
        $item->save();

        $image = $request->file('itemImage');

        Image::storeAsPng($image, 'public\images\merchandise\\', $item->id . '.png');

        session()->flash('success', 'The item called '.$item->name.' was created.');
        return redirect()->back();
    }

    /**
     *  Updates auctionItem
     */
    public function update(Request $request, $itemId){
        
        $this->validate($request,[
            'name' => 'string|required',
            'description' => 'string|required|max:300',
            'itemImage' => 'mimes:jpg,jpeg,png|max:2000'
        ]);


        $item = AuctionItem::find($itemId);

        $item->name = $request->input('name');
        $item->desc = $request->input('description');
        $item->donor = $request->input('donor');
        $item->donor_url = $request->input('donorUrl');
                
        // Update image if a file was uploaded
        if($image = $request->file('itemImage')){
            Image::storeAsPng($image, 'public\images\auction\\', $item->id . '.png');
        }

        $item->save();

        session()->flash('success', $item->name . ' was updated.');

        return redirect()->back();
    }


    /**
     * Soft deletes selected merchandise item
     * 
     * @param $id
     */
    public function destroy($id)
    {
        $item = MerchandiseItem::find($id);
        $item->delete();
        session()->flash('success', 'The merchandise item '.$item->name.' was deleted.'); 
        
        return redirect()->back();
    }

    /**
     * Restores selected soft deleted merchandise item
     * 
     * @param $id
     */
    public function restore($id){

        $item = MerchandiseItem::withTrashed()->find($id);
        $item->restore();
        session()->flash('success', 'The merchandise item '.$item->name.' was restored');

        return redirect()->back();
    }
}
