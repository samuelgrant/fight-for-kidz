<?php

namespace App\Http\Controllers\admin;

use App\Document;
use App\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SiteSettingsController extends Controller
{
    public function homePage() {
        $settings = SiteSetting::getHomePage();
        if(!$settings['display_merch']) {
            $settings['display_merch'] = false;
        }
        
        return response()->json($settings);
    }

    // Update settings
    public function update(Request $request){        
        $this->validate($request, [
            'aboutUs' => 'required|string|max:1000',
            'mainPagePhoto' => 'mimes:jpg,jpeg|max:2000',
        ]);

        $settings = SiteSetting::getSettings();

        $settings->about_us = $request->input('aboutUs');
        $settings->display_merch = $request->input('displayMerch') ? true : false;        
        $settings->setMainPhoto($request->file('mainPagePhoto'));
        $settings->save();


        session()->flash('success', 'Site settings updated successfully');

        return redirect()->back();

    }

    // Following three methods relate to files uploaded by admins for 
    // download by the public.

    public function storeFile(Request $request){

        // validate file here - file size max can be adjusted if PHP limit allows
        $this->validate($request, [
            'uploaded' => 'required|max:10000|mimes:doc,docx,bmp,gif,jpg,jpeg,png,pdf,rtf,xls,xlsx,txt', //limiting file types for security
            'location' => 'required'
        ]);

        // get file from request
        $file = $request->file('uploaded');      

        // get file name and extension
        $fileName = $file->getClientOriginalName();

        // store the file in the documents directory
        $uniqueName = Storage::disk('documents')->put('/', $file); // this function generates and returns unique file name

        // create record of file
        $doc = new Document;
        $doc->display_location = $request->input('location'); // which page do the public download from?
        $doc->originalName = $fileName; // for the a tag contents
        $doc->filename = $uniqueName; // for identifying the actual file
        $doc->save();
        
        session()->flash('success', 'File uploaded successfully');

        return redirect()->back();
    }

    public function updateFile(Request $request, $docID){

        $document = Document::find($docID);

        $document->display_location = $request->input('location');
        $document->save();

        session()->flash('success', 'File display location updated successfully');

        return redirect()->back();
    }

    public function deleteFile($docID){

        $document = Document::find($docID);

        // delete the file on the disk
        Storage::disk('documents')->delete('/', $document->filename);

        // delete the database record of the file
        $document->delete();

        session()->flash('success', 'File deleted successfully');

        return redirect()->back();
    }

    // For the update file modal 
    public function getFile($docID){

        $doc = Document::find($docID);

        return [
            'display_location' => $doc->display_location
        ];
    }
}
