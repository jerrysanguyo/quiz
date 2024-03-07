<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class unauthorizedAccess extends Controller
{
    public function unauthorized () {
        return view('pages.unauthorized');
    }
}
