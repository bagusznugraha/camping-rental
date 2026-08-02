<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Rental::with([
            'user',
            'rentalDetails.equipment'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Filter Tanggal
        |--------------------------------------------------------------------------
        */

        if ($request->filled('start_date')) {

            $query->whereDate(
                'rental_date',
                '>=',
                $request->start_date
            );

        }

        if ($request->filled('end_date')) {

            $query->whereDate(
                'rental_date',
                '<=',
                $request->end_date
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Filter Status
        |--------------------------------------------------------------------------
        */

        if (
            $request->filled('status') &&
            $request->status != 'semua'
        ) {

            $query->where(
                'status',
                $request->status
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Data Tabel
        |--------------------------------------------------------------------------
        */

        $rentals = $query
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */

        $totalPendapatan = Rental::where(
            'status',
            'selesai'
        )->sum('total_price');

        $totalSewa = Rental::count();

        $menunggu = Rental::where(
            'status',
            'menunggu'
        )->count();

        $diproses = Rental::where(
            'status',
            'diproses'
        )->count();

        $siapDiambil = Rental::where(
            'status',
            'siap_diambil'
        )->count();

        $dipinjam = Rental::where(
            'status',
            'dipinjam'
        )->count();

        $selesai = Rental::where(
            'status',
            'selesai'
        )->count();

        /*
        |--------------------------------------------------------------------------
        | Kirim ke View
        |--------------------------------------------------------------------------
        */

        return view(
            'reports.index',
            compact(
                'rentals',
                'totalPendapatan',
                'totalSewa',
                'menunggu',
                'diproses',
                'siapDiambil',
                'dipinjam',
                'selesai'
            )
        );
    }
}