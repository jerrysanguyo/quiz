<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\quiz;
use App\Models\User;
use App\Models\score;
use Illuminate\Support\Facades\DB;

class examScoreController extends Controller
{
    public function scoreIndex(Request $request, $detailId) {
        $userId = $detailId;
    
        $userAnswers = DB::table('user_answer')
            ->join('question', 'user_answer.question_id', '=', 'question.id')
            ->select('question.qDescription as question', 'user_answer.result as result', 'user_answer.answer as answer', 'user_answer.time_spent as timespent', DB::raw('(user_answer.answer = question.qAnswer) as is_correct'))
            ->where('user_id', $userId)
            ->whereIn('user_answer.result', [0, 1])
            ->get();
    
        $totalQuestionsCount = $userAnswers->count();
        $correctAnswersCount = $userAnswers->where('is_correct', true)->count();
        $incorrectAnswersCount = $userAnswers->where('is_correct', false)->count();
    
        if ($totalQuestionsCount == 0) {
            return view('examScore', [
                'showQuizButton' => true
            ]);
        }
    
        $totalScore = ($correctAnswersCount / $totalQuestionsCount) * 100;
    
        return view('examScore', [
            'totalScore' => $totalScore
        ]);
    }

    public function secondScoreAdd(Request $request, $scoreToken) {
        $data=$request->validate([
            'user_scoreId' => $request->$scoreToken,
            'examType' => 'second',
            'score' => 'required',
            'added_by' => auth()->user()->id
        ]);

        $addSecond=score::create($data);
        return redirect()->route('score-index');
    }
}
