<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->type === 'admin') { 
            return $next($request);
        } else {
            return redirect()->route('unauthorized');
        }
    }
}
