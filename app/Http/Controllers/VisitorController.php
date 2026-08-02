<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Carbon\Carbon;

class VisitorController extends Controller
{
    public function index()
{
    $todayVisitors = Visitor::whereDate('visit_date', Carbon::today())->count();

    $weekVisitors = Visitor::whereBetween(
        'visit_date',
        [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ]
    )->count();

    $monthVisitors = Visitor::whereMonth('visit_date', Carbon::now()->month)
        ->whereYear('visit_date', Carbon::now()->year)
        ->count();

    $yearVisitors = Visitor::whereYear('visit_date', Carbon::now()->year)
        ->count();

    $visitors = Visitor::latest('id')->get();

    return view('visitors.index', compact(
        'visitors',
        'todayVisitors',
        'weekVisitors',
        'monthVisitors',
        'yearVisitors'
    ));
}
}