<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;

class VisitorMiddleware
{
    public function handle(Request $request, Closure $next): Response
{
    if (auth()->check() && !session()->has('visitor_recorded')) {

        Visitor::create([
            'user_id' => auth()->id(),
            'visitor_name' => auth()->user()->name,
            'role' => auth()->user()->role,
            'visit_date' => now()->toDateString(),
            'visit_time' => now()->toTimeString(),
        ]);

        session()->put('visitor_recorded', true);
    }

    return $next($request);
}
}