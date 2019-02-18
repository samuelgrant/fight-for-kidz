<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\ReceivedMessage;
use App\Http\Controllers\Controller;

class MessagesController extends Controller
{
    /**
     * Return the index view of all messages
     */
    public function index(){
        return view('admin.messages')->with('messages', ReceivedMessage::all())
                                    ->with('deletedMessages', ReceivedMessage::onlyTrashed()->get());
    }

    /**
     * Return a view of a single message
     */
    public function view($messageID){

        // Mark as read
        $message = ReceivedMessage::find($messageID);
        $message->read = true;
        $message->save();

        return view('admin.message')->with('msg', ReceivedMessage::find($messageID));
    }

    public function delete($messageID){
        $message = ReceivedMessage::find($messageID);
        $message->delete();

        session()->flash('success', 'Message has been moved to trash');
        return redirect()->back();
    }

    public function restore($messageID){
        $message = ReceivedMessage::withTrashed()->find($messageID);
        $message->deleted_at = null;
        $message->save();

        session()->flash('success', 'Message has been restored');
        return redirect()->back();
    }

    public function markAsUnread($messageID){

        $message = ReceivedMessage::find($messageID);
        $message->read = false;
        $message->save();

        // Returns to main messages view afterwards
        return view('admin.messages')->with('messages', ReceivedMessage::all())
                                    ->with('deletedMessages', ReceivedMessage::onlyTrashed()->get());

    }
}
