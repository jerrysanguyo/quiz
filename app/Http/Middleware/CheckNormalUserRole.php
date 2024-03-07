<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckNormalUserRole
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->type === 'user') {
            return $next($request);
            // return redirect()->route('quiz');
        }
        
        return redirect()->route('unauthorized');
    }
}