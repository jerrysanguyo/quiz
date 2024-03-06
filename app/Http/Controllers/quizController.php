<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\question;
use App\Models\quiz;
use App\Models\User;

class quizController extends Controller
{

    public function getQuizTakers() {
        $takers = User::leftJoin(DB::raw('(SELECT user_id, MAX(created_at) as max_created_at FROM user_answer GROUP BY user_id) as max_dates'), function($join) {
                                $join->on('users.id', '=', 'max_dates.user_id');
                            })
                          ->leftJoin(DB::raw('(SELECT user_id, SUM(result) AS total_score FROM user_answer GROUP BY user_id) AS scores'), 'users.id', '=', 'scores.user_id')
                          ->select('users.id', 'users.name', DB::raw('DATE(max_dates.max_created_at) AS date'), 'scores.total_score')
                          ->get();
        
            return view('home', ['takers' => $takers]); 
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
    
        return view('quiz.score', [
            'userAnswers' => $userAnswers,
            'correctAnswersCount' => $correctAnswersCount,
            'incorrectAnswersCount' => $incorrectAnswersCount
        ]);
    }

    public function score() {
        $userId = auth()->id();
        if (!$userId) {
            return redirect()->route('quiz')->with('error', 'Unable to fetch user ID.');
        }
    
        $userAnswers = DB::table('user_answer')
            ->join('question', 'user_answer.question_id', '=', 'question.id')
            ->select('question.qDescription as question', 'user_answer.result as result', 'user_answer.answer as answer', 'user_answer.time_spent as timespent', DB::raw('(user_answer.answer = question.qAnswer) as is_correct'))
            ->where('user_id', $userId)
            ->whereIn('user_answer.result', [0, 1])
            ->get();
    
        $correctAnswersCount = $userAnswers->where('is_correct', true)->count();
        $incorrectAnswersCount = $userAnswers->where('is_correct', false)->count();
    
        return view('quiz.score', [
            'userAnswers' => $userAnswers,
            'correctAnswersCount' => $correctAnswersCount,
            'incorrectAnswersCount' => $incorrectAnswersCount
        ]);
    }
    
    
    public function quiz() {
        $userId = auth()->id();
    
        $answeredQuestionIds = DB::table('user_answer')
            ->where('user_id', $userId)
            ->pluck('question_id')
            ->toArray();
    
        $listQuestion = DB::table('question')
            ->whereNotIn('id', $answeredQuestionIds)
            ->limit(1)
            ->get();
    
        if ($listQuestion->isEmpty()) {
            return redirect()->route('final-score');
        }
    
        return view('quiz.quiz', ['listQuestion' => $listQuestion]);
    }

    public function questionAnswer (Request $request) {
        
        $request->validate([
            'question_id' => 'required',
            'answer' => 'required',
            'time_spent' => 'required'
        ]);

        $selectedAnswer = $request->input('answer');

        $question = Question::find($request->question_id);

        if (!$question) {
            return redirect()->back()->with('error', 'Invalid question ID.');
        }

        $correctAnswer = $question->qAnswer;

        $data = [
            'user_id' => $request->user_id,
            'question_id' => $request->question_id,
            'answer' => $request->answer,
            'result' => ($selectedAnswer === $correctAnswer) ? '1' : '0',
            'time_spent' => $request->time_spent
        ];

        $newAnswer = Quiz::create($data);

        return redirect(route('quiz'));
    }
}
