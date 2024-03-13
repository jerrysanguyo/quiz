<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\quiz;
use App\Models\User;
use App\Models\disability;
use Illuminate\Support\Facades\DB;

class adminQuizController extends Controller
{
    public function getQuizTakers() {
        $takers = User::leftJoin(DB::raw('(SELECT user_id, MAX(created_at) as max_created_at FROM user_answer GROUP BY user_id) as max_dates'), function($join) {
                                $join->on('users.id', '=', 'max_dates.user_id');
                            })
                          ->leftJoin(DB::raw('(SELECT user_id, SUM(result) AS total_score FROM user_answer GROUP BY user_id) AS scores'), 'users.id', '=', 'scores.user_id')
                          ->leftJoin('disabilities', 'users.disability_id', '=', 'disabilities.id') 
                          ->whereNotIn('users.type', ['admin', 'judge', 'superadmin'])
                          ->select('users.id', 'users.name', 'disabilities.disability_name as disability_name', DB::raw('DATE(max_dates.max_created_at) AS date'), 'scores.total_score')
                          ->groupBy('disability_name', 'quiz.users.id','quiz.users.name', 'date', 'scores.total_score')
                          ->get();
    
        $view = auth()->user()->type === 'admin' ? 'home' : 'judge.index'; 
        return view($view, ['takers' => $takers]);  
    }

    public function quizDetails(Request $request) {
        $takerId = $request->route('detail'); 
        $userAnswers = quiz::where('user_id', $takerId)->get();
    
        $userAnswers = DB::table('user_answer')
            ->join('question', 'user_answer.question_id', '=', 'question.id')
            ->select('question.qDescription as question', 'user_answer.result as result', 'user_answer.answer as answer', 'user_answer.time_spent as timespent', DB::raw('(user_answer.answer = question.qAnswer) as is_correct'))
            ->where('user_id', $takerId)
            ->whereIn('user_answer.result', [0, 1])
            ->get();
    
        $correctAnswersCount = $userAnswers->where('is_correct', true)->count();
        $incorrectAnswersCount = $userAnswers->where('is_correct', false)->count();
        
        $view = auth()->user()->type === 'admin' ? 'quiz.score' : 'judge.score';
        return view($view, [
            'userAnswers' => $userAnswers,
            'correctAnswersCount' => $correctAnswersCount,
            'incorrectAnswersCount' => $incorrectAnswersCount
        ]);
    }

    public function disability() {
        $listOfDisability = disability::all();
        return view('disability.index', ['listOfDisability' => $listOfDisability]);
    }

    public function disabilityCreate(Request $request){
        $data=$request->validate([
            'disability_name'=>'required|string'
        ]);

        $newQuestion = disability::create($data);

        return redirect(route('disability'));
    }

    public function updateDisability(Disability $disability, Request $request) {
        $updateData=$request->validate([
            'disability_name'=>'string',
        ]);

        $disability->update($updateData);

        return redirect(route('disability'))->with('success', 'Disability updated successfully!');
    }

    public function deleteDisabiltiy (Disability $disability) {
        $disability->delete();
        return redirect(route('disability'))->with('success', 'Disability deleted successfully!');
    }

    public function editDisability(Disability $disability) {
        return view('disability.editDisability', ['disability'=>$disability]);
    }
}
