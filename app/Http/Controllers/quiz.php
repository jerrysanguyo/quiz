<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class quiz extends Controller
{
    public function quiz() {
        return view('quiz.quiz');
    }
}
