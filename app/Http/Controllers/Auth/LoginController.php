<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user) {
        if($user->type === 'admin') {
            return redirect()->route('takers');
        } elseif($user->type === 'judge') {
            return redirect()->route('judge-dashboard');
        } elseif($user->type === 'superadmin') {
            return redirect()->route('superadmin-dashboard');
        }
        
        return redirect()->route('user-home');
    }
}
