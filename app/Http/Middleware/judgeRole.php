<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class judgeRole
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->type === 'judge') { 
            return $next($request);
        } else {
            return redirect()->route('unauthorized');
        }
    }
}
