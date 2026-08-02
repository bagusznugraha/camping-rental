<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        // Hanya catat sekali per hari
        if (!session()->has('visitor_logged')) {

            $user = auth()->user();

            Visitor::create([
                'user_id' => $user?->id,
                'visitor_name' => $user?->name ?? 'Guest',
                'role' => $user?->role ?? 'guest',
                'visit_date' => Carbon::today(),
                'visit_time' => Carbon::now()->format('H:i:s'),
            ]);

            session(['visitor_logged' => true]);
        }

        return $next($request);
    }
}