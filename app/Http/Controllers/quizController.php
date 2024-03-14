<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\question;
use App\Models\quiz;
use App\Models\User;
use App\Models\score;

class quizController extends Controller
{
    public function score() 
    {
        $userId = auth()->id();
        if (!$userId) {
            return redirect()->route('quiz')->with('error', 'Unable to fetch user ID.');
        }
    
        $userAnswers = Quiz::with('question') 
                           ->where('user_id', $userId)
                           ->whereIn('result', [0, 1])
                           ->get();
    
        $correctAnswersCount = $userAnswers->where('is_correct', true)->count();
        $incorrectAnswersCount = $userAnswers->where('is_correct', false)->count();
    
        return view('quiz.score', [
            'userAnswers' => $userAnswers,
            'correctAnswersCount' => $correctAnswersCount,
            'incorrectAnswersCount' => $incorrectAnswersCount
        ]);
    }
    
    public function quiz() 
    {
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

    public function questionAnswer (Request $request) 
    {
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

    public function userHome() 
    {
        $userId = auth()->id();
        if (!$userId) {
            return redirect()->route('quiz')->with('error', 'Unable to fetch user ID.');
        }

        $user = User::with(['answers.question', 'scores']) 
                    ->findOrFail($userId);

        $correctAnswersCount = $user->answers->reduce(function ($carry, $item) {
            return $carry + (($item->answer === $item->question->qAnswer) ? 1 : 0);
        }, 0);

        $totalQuestionsCount = $user->answers->count();
        $incorrectAnswersCount = $totalQuestionsCount - $correctAnswersCount;

        $totalScore = $totalQuestionsCount ? round(($correctAnswersCount / $totalQuestionsCount) * 100, 2) : null;

        $secondExamScore = optional($user->scores->where('examType', 'second')->first())->score;
        $thirdExamScore = optional($user->scores->where('examType', 'third')->first())->score;

        $scores = array_filter([$totalScore, $secondExamScore, $thirdExamScore], function($value) {
            return !is_null($value);
        });

        $overAll = $scores ? round(array_sum($scores) / count($scores), 2) : null;

        $showQuizButton = $totalQuestionsCount === 0;

        return view('userHome', compact('totalScore', 'showQuizButton', 'secondExamScore', 'thirdExamScore', 'overAll'));
    }
}
