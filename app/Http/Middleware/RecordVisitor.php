<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;

class RecordVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        Visitor::create([
            'user_id' => auth()->check() ? auth()->id() : null,
            'visitor_name' => auth()->check() ? auth()->user()->name : 'Guest',
            'role' => auth()->check() ? auth()->user()->role : 'Guest',
            'visit_date' => now()->toDateString(),
            'visit_time' => now()->toTimeString(),
        ]);

        return $next($request);
    }
}