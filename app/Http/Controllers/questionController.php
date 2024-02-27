<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\question;

class questionController extends Controller
{
    public function question() {
        return view('pages.question');
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

        return redirect(route('home'));
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

        return redirect(route('home'))->with('success', 'Question updated successfully!');
    }

    public function deleteQuestion(question $question) {
        $question->delete();
        return redirect(route('home'))->with('success', 'Question deleted successfully!');
    }
}
