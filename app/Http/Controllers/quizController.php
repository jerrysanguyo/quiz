<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\question;
use App\Models\quiz;

class quizController extends Controller
{
    public function quiz() {
        $listQuestion = DB::table('question')->inRandomOrder()->limit(1)->get();
        return view('quiz.quiz', ['listQuestion' => $listQuestion]);
    }
}
