<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\quiz;
use App\Models\User;
use App\Models\disability;
use App\Models\score;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DisabilityRequest;
use App\Http\Requests\ScoreRequest;

class adminQuizController extends Controller
{
    public function getQuizTakers()
    {
        $takers = User::with(['disability', 'answers.question', 'scores'])
                        ->whereNotIn('type', ['admin', 'judge', 'superadmin'])
                        ->get()
                        ->map(function ($user) {
                            $firstAssessmentScore = $this->calculateFirstAssessmentScoreForUser($user);
                            $totalScores = $user->scores->sum('score');
                            $overallScore = ($firstAssessmentScore + $totalScores) / 3; 
                            $user->overall_score = round($overallScore, 2);
                            return $user;
                        });

        $view = auth()->user()->type === 'admin' ? 'home' : 'judge.index';
        return view($view, compact('takers'));
    }

    protected function calculateFirstAssessmentScoreForUser($user)
    {
        $totalQuestions = $user->answers->count();
        if ($totalQuestions === 0) {
            return 0;
        }

        $correctAnswersCount = $user->answers->reduce(function ($carry, $item) {
            return $carry + ($item->answer === $item->question->qAnswer ? 1 : 0);
        }, 0);

        return round(($correctAnswersCount / $totalQuestions) * 100, 2);
    }

    public function quizDetails(Request $request)
    {
        $userId = $request->route('detail');
        $user = User::with(['answers.question'])->findOrFail($userId);
    
        $userAnswers = $user->answers->each(function ($answer) {
            $answer->is_correct = $answer->answer == $answer->question->qAnswer;
        });
    
        $correctAnswersCount = $userAnswers->where('is_correct', true)->count();
        $incorrectAnswersCount = $userAnswers->where('is_correct', false)->count();
    
        $view = auth()->user()->type === 'admin' ? 'quiz.score' : 'judge.score';
        return view($view, compact('user', 'userAnswers', 'correctAnswersCount', 'incorrectAnswersCount'));
    }

    public function disability()
    {
        $listOfDisability = Disability::all();
        return view('disability.index', compact('listOfDisability'));
    }

    public function disabilityCreate(DisabilityRequest $request)
    {
        $validatedData = $request->validated();
        Disability::create($validatedData);
        return redirect()->route('disability')->with('success', 'Disability created successfully!');
    }

    public function editDisability(Disability $disability)
    {
        return view('disability.editDisability', compact('disability'));
    }

    public function updateDisability(Disability $disability, DisabilityRequest $request)
    {
        $disability->update($request->validated());
        return redirect()->route('disability')->with('success', 'Disability updated successfully!');
    }

    public function deleteDisability(Disability $disability)
    {
        $disability->delete();
        return redirect()->route('disability')->with('success', 'Disability deleted successfully!');
    }

    public function scoreIndex($userId) 
    {
        $user = User::with(['answers.question', 'scores'])->findOrFail($userId);
    
        \Log::info('Total Answers Count: ', ['count' => $user->answers->count()]);
        
        $correctAnswersCount = $user->answers->reduce(function ($carry, $item) {
            return $carry + (($item->answer == $item->question->qAnswer) ? 1 : 0);
        }, 0);
    
        $totalQuestionsCount = $user->answers->count();
        $incorrectAnswersCount = $totalQuestionsCount - $correctAnswersCount;
        \Log::info('Correct Answers Count: ', ['count' => $correctAnswersCount]);
    
        $totalScore = $totalQuestionsCount ? round(($correctAnswersCount / $totalQuestionsCount) * 100, 2) : 0;
    
        $secondExamScore = optional($user->scores->where('examType', 'second')->first())->score;
        $thirdExamScore = optional($user->scores->where('examType', 'third')->first())->score;
    
        $scores = array_filter([$totalScore, $secondExamScore, $thirdExamScore], function($value) {
            return !is_null($value);
        });
        
        $overAll = $scores ? round(array_sum($scores) / count($scores), 2) : null;
    
        return view('examScore', compact('user', 'totalScore', 'secondExamScore', 'thirdExamScore', 'overAll'));
    }

    public function secondScoreAdd(Request $request)
    {
        Score::create([
            'user_scoreId' => $request->user_scoreId,
            'score' => $request->score,
            'examType' => 'second',
            'added_by' => auth()->user()->id,
        ]);
        return redirect()->route('takers')->with('success', 'Second exam score added successfully!');
    }

    public function thirdScoreAdd(Request $request)
    {
        Score::create([
            'user_scoreId' => $request->user_scoreId,
            'score' => $request->score,
            'examType' => 'third',
            'added_by' => auth()->user()->id,
        ]);
        return redirect()->route('takers')->with('success', 'Third exam score added successfully!');
    }
}
