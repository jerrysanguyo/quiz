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
                            $user->firstAssessmentScore = $this->calculateFirstAssessmentScoreForUser($user);
                            $user->secondAssessmentScore = $this->calculateSecondAssessmentScoreForUser($user); 
                            $user->thirdAssessmentScore = $this->calculateThirdAssessmentScoreForUser($user); 
    
                            $scores = array_filter([$user->firstAssessmentScore, $user->secondAssessmentScore, $user->thirdAssessmentScore]);
                            $user->overall_score = !empty($scores) ? round(array_sum($scores) / count($scores), 2) : null;
    
                            // Determine if the user is exempted from the third assessment
                            $thirdExempted = $user->scores->filter(function ($score) {
                                return $score->examType == 'third' && $score->exempted == 'Yes';
                            })->isNotEmpty(); // Use isNotEmpty to get a boolean result
    
                            // Set the thirdExempted property on the user object
                            $user->thirdExempted = $thirdExempted;
    
                            return $user;
                        });
    
        $view = auth()->user()->type === 'admin' ? 'home' : 'judge.index';
    
        return view($view, compact('takers'));
    }
    
    protected function calculateSecondAssessmentScoreForUser($user)
    {
        $secondAssessmentScore = $user->scores->where('examType', 'second')->first();
    
        return $secondAssessmentScore ? $secondAssessmentScore->score : null;
    }
    
    protected function calculateThirdAssessmentScoreForUser($user)
    {
        $thirdAssessmentScore = $user->scores->where('examType', 'third')->first();
    
        return $thirdAssessmentScore ? $thirdAssessmentScore->score : null;
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
        $thirdExempted = optional($user->scores->where('examType', 'third', 'exempted', 'Yes')->first())->score;

        $thirdExempted = $user->scores->filter(function ($score) {
            return $score->examType == 'third' && $score->exempted == 'Yes';
        })->first();

        $thirdExemptedScore = optional($thirdExempted)->score;
    
        $scores = array_filter([$totalScore, $secondExamScore, $thirdExamScore], function($value) {
            return !is_null($value);
        });
        
        $overAll = $scores ? round(array_sum($scores) / count($scores), 2) : null;
    
        return view('examScore', compact('user', 'totalScore', 'secondExamScore', 'thirdExamScore', 'overAll', 'thirdExempted'));
    }

    public function secondScoreAdd(Request $request)
    {
        Score::create([
            'user_scoreId' => $request->user_scoreId,
            'score' => $request->score,
            'examType' => 'second',
            'exempted' => 'No',
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
            'exempted' => 'No',
            'added_by' => auth()->user()->id,
        ]);
        return redirect()->route('takers')->with('success', 'Third exam score added successfully!');
    }

    public function exempt(Request $request) {
        Score::create([
            'user_scoreId' => $request->user_scoreId,
            'examType' => 'third',
            'exempted' => 'Yes',
            'added_by' => auth()->user()->id,
        ]);

        return redirect()->route('takers')->with('success', 'This user has been exempted for third assessment successfully!');
    }
}
