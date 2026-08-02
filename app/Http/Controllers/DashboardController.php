<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Equipment;
use App\Models\Rental;
use App\Models\User;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEquipment = Equipment::count();

        $totalCategory = Category::count();

        $totalCustomer = User::where('role', 'pelanggan')->count();

        $totalRental = Rental::count();

        $waitingRental = Rental::where('status', 'menunggu')->count();

        $borrowedRental = Rental::where('status', 'dipinjam')->count();

        $finishedRental = Rental::where('status', 'selesai')->count();

        // Pembayaran yang menunggu diverifikasi admin
        $waitingPayment = Payment::where(
            'status',
            'Menunggu Verifikasi'
        )->count();

        $latestRentals = Rental::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalEquipment',
            'totalCategory',
            'totalCustomer',
            'totalRental',
            'waitingRental',
            'borrowedRental',
            'finishedRental',
            'waitingPayment',
            'latestRentals'
        ));
    }
}