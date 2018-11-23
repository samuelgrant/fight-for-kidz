<?php

namespace App\Http\Controllers\admin;

use App\CustomQuestion;
use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionManagementController extends Controller
{
    /**
     * Adds a custom question to the given event
     */
    public function addQuestion(Request $request, $eventID){

        $this->validate($request, [
            'question' => 'required',
        ]);

        $event = Event::find($eventID);

        // do not allow if the limit of 5 has been reached
        if(count($event->customQuestions) > 4){

            session()->flash('error', 'Limit of 5 custom questions has been reached.');

        } elseif(count($event->applicants) > 0) { // do not allow if any applications have already been received

            session()->flash('error', 'Cannot add questions after applications have been received.');

        } else { // go ahead a save a new question

            $q = new CustomQuestion;
            $q->text = $request->input('question');
            $q->type = $request->input('type');
            $q->required = $request->input('required') == 'Yes' ? true : false; 
            $q->event_id = $event->id;
            $q->save();

            session()->flash('success', 'Custom question created successfully');
        }

        return redirect()->back();

    }

    /**
     * Removes the given question
     */
    public function removeQuestion($questionID){

        $question = CustomQuestion::find($questionID);

        // do not allow if applications have been received
        if(count($question->event->applicants) > 0){

            session()->flash('error', 'Cannot remove questions after applications have been received');

        } else { // go ahead and remove the question

            $question->delete();

            session()->flash('success', 'Question removed successfully');

        }

        return redirect()->back();

    }

    /**
     * Update the given question 
     * 
     * Currently unimplemented, simply delete question and remake it 
     * to change what it is.
     */
    public function updateQuestion(){

        return redirect()->back();

    }
}
