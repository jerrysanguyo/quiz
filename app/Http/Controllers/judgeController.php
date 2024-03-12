<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\quiz;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class judgeController extends Controller
{
    public function judgeDashboard() {
        return view('judge.index');
    }
}
