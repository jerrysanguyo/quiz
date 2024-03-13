<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\question;

class questionController extends Controller
{
    
    public function listOfQuestion () {
        $listQuestion = question::all();
        return view('pages.question', ['listQuestion' => $listQuestion]);
    }

    public function formQuestion() {
        $lastQuestion = Question::latest()->first(); // Retrieve the last question
        $lastQNumber = $lastQuestion ? $lastQuestion->qNumber : 0; // Get the qNumber of the last question, or default to 0 if there are no questions yet
        
        return view('pages.addQuestion', ['lastQNumber' => $lastQNumber]);
    }

    public function addQuestion(Request $request) {
        $data=$request->validate([
            'qNumber'=>'required|numeric',
            'qDescription'=>'required',
            'qAnswer'=>'required',
            'qChoicesB'=>'required',
            'qChoicesC'=>'required',
            'qChoicesD'=>'required',
            'added_by'=>'required'
        ]);

        $newQuestion = question::create($data);

        return redirect(route('question'));
    }

    public function editQuestion(question $question) {
        return view('pages.editQuestion', ['question'=>$question]);
    }

    public function updateQuestion(question $question, Request $request) {
        $updateData=$request->validate([
            'qNumber'=>'required|numeric',
            'qDescription'=>'required',
            'qAnswer'=>'required',
            'qChoicesB'=>'required',
            'qChoicesC'=>'required',
            'qChoicesD'=>'required',
        ]);
        
        $question->update($updateData);

        return redirect(route('question'))->with('success', 'Question updated successfully!');
    }

    public function deleteQuestion(question $question) {
        $question->delete();
        return redirect(route('question'))->with('success', 'Question deleted successfully!');
    }
}
