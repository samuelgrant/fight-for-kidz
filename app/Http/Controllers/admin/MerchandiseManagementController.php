<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MerchandiseItem;
use App\Image;
use App\SiteSetting;

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
            return [
                'id' => $item->id,
                'name' => $item->name,
                'desc' => $item->desc,
                'tagline' => $item->tagline,
                'price' => $item->price
            ];
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
            'itemImage' => 'mimes:jpg,jpeg,png|max:2000',
            'price' => 'numeric|required',
        ]);

        $item = new MerchandiseItem();
            $item->name = $request->input('name');
            $item->tagline = $request->input('tagline');
            $item->desc = $request->input('description');
            $item->price = $request->input('price')            ;
        $item->save();

        if($image = $request->file('itemImage'))
        {
            Image::storeAsPng($image, 'public/images/merchandise/', $item->id . '.png');
        }        

        session()->flash('success', 'The item called '.$item->name.' was created.');
        return redirect()->back();
    }

    /**
     *  Updates merchandise item
     */
    public function update(Request $request, $itemId){
        
        $this->validate($request,[
            'name' => 'string|required',
            'description' => 'string|required|max:300',
            'itemImage' => 'mimes:jpg,jpeg,png|max:2000',
            'price' => 'numeric|required'
        ]);


        $item = MerchandiseItem::find($itemId);

        $item->name = $request->input('name');
        $item->tagline = $request->input('tagline');
        $item->desc = $request->input('description');
        $item->price = $request->input('price');
                
        // Update image if a file was uploaded
        if($image = $request->file('itemImage')){
            Image::storeAsPng($image, 'public/images/merchandise/', $item->id . '.png');
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

    /**
     *  Toggle visibility of the merchandise page.
     */
    public function toggleAll(){
        $settings = SiteSetting::getSettings();

        if($settings->display_merch){
            $settings->display_merch = false;
            session()->flash('success', 'The merchandise page has been disabled. It will NOT show on the public website.');
        } else{
            $settings->display_merch = true;
            session()->flash('success', 'The merchandise page has been enabled. It WILL show on the public website.');
        }

        $settings->save();

        return redirect()->back();
    }

    /**
     *  Toggle individual item visibitiy on merchandise page.
     */
    public function toggleMerchandiseItem($itemID){
        
        $item = MerchandiseItem::find($itemID);

        if($item){ //toggle the item visibility
            if($item->item_visible){
                $item->hideMerchandiseItem();
                session()->flash('success', $item->name . ' will NOT show on merchandise page');
            } else{
                $item->showMerchandiseItem();
                session()->flash('success', $item->name . ' WILL show on Merchandise page');
            }
        } else{ // if for some reason the itemID does not find an item
            session()->flash('error', 'Error. The requested action could not be completed.');
        }

        return redirect()->back();
    }
}
