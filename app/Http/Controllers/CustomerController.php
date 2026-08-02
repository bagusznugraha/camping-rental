<?php

namespace App\Http\Controllers;

use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::whereIn('role', ['admin', 'pelanggan'])
    ->withCount('rentals')
    ->latest()
    ->get();
        return view('customer.index', compact('customers'));
    }
}