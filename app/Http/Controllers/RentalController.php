<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Rental;
use App\Models\RentalDetail;
use App\Models\Payment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RentalController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $rentals = Rental::with([
            'user',
            'payment',
            'rentalDetails.equipment'
        ])->latest()->get();

        return view('rentals.index', compact('rentals'));
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL
    |--------------------------------------------------------------------------
    */

    public function show(Rental $rental)
    {
        $rental = Rental::with([
            'user',
            'payment',
            'rentalDetails.equipment',
            'chats'
        ])->findOrFail($rental->id);

        return view('rentals.show', compact('rental'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM RENTAL
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return redirect()->route('customer.equipment');
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN RENTAL
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'equipment'       => 'required|array|min:1',
            'quantity'        => 'required|array',
            'start_date'      => 'required|date|after_or_equal:today',
            'rental_days'     => 'required|integer|min:1|max:30',
            'phone'           => 'required|string|max:20',
            'address'         => 'required|string',
            'pickup_method'   => 'required|in:Diambil,Dikirim',
            'payment_method'  => 'required',
            'payment_type'    => 'required|in:deposit,full',
        ]);

        DB::transaction(function () use ($request) {

            $days = (int) $request->rental_days;

            $startDate = Carbon::parse($request->start_date);

            $returnDate = $startDate->copy()->addDays($days);

            $depositDeadline = $startDate->copy()->subDays(2);

            $deliveryFee = $request->pickup_method == 'Dikirim'
                ? 20000
                : 0;

            $rental = Rental::create([
                'user_id'              => auth()->id(),
                'start_date'           => $startDate,
                'rental_date'          => $startDate,
                'return_date'          => $returnDate,
                'rental_days'          => $days,
                'phone'                => $request->phone,
                'address'              => $request->address,
                'pickup_method'        => $request->pickup_method,
                'delivery_fee'         => $deliveryFee,
                'pickup_deadline'      => null,
                'pickup_deadline_time' => null,
                'total_price'          => 0,
                'status'               => 'menunggu',
            ]);

            $total = 0;

            foreach ($request->equipment as $equipmentId) {

                $equipment = Equipment::findOrFail($equipmentId);

                $qty = max(1, $request->quantity[$equipmentId] ?? 1);

                if ($qty > $equipment->stock) {
                    abort(403, "Stok {$equipment->name} tidak mencukupi.");
                }

                $subtotal = $equipment->price * $qty * $days;

                RentalDetail::create([
                    'rental_id'   => $rental->id,
                    'equipment_id'=> $equipment->id,
                    'quantity'    => $qty,
                    'price'       => $equipment->price,
                    'subtotal'    => $subtotal,
                ]);

                $equipment->decrement('stock', $qty);
                $equipment->increment('rent_count');

                $total += $subtotal;
            }

            $grandTotal = $total + $deliveryFee;

            $deposit = round($grandTotal * 0.10);

            $remaining = $grandTotal - $deposit;

            $rental->update([
                'total_price'       => $total,
                'deposit_amount'    => $deposit,
                'remaining_payment' => $remaining,
                'deposit_deadline'  => $depositDeadline,
                'deposit_status'    => 'belum_bayar',
            ]);

            if ($request->payment_type == 'deposit') {

                $amountPaid = $deposit;
                $remainingAmount = $remaining;

            } else {

                $amountPaid = $grandTotal;
                $remainingAmount = 0;

            }

            Payment::create([
                'rental_id'          => $rental->id,
                'payment_method'     => $request->payment_method,
                'payment_type'       => $request->payment_type,
                'amount'             => $grandTotal,
                'amount_paid'        => $amountPaid,
                'remaining_amount'   => $remainingAmount,
                'deposit_deadline'   => $depositDeadline,
                'status'             => 'Belum Bayar',
            ]);

            Notification::create([
                'user_id' => auth()->id(),
                'title'   => 'Penyewaan Berhasil',
                'message' => 'Silakan lakukan pembayaran agar penyewaan diproses Admin.',
                'is_read' => false,
            ]);
        });

        return redirect()
            ->route('payment.show')
            ->with(
                'success',
                'Penyewaan berhasil dibuat. Silakan upload bukti pembayaran.'
            );
    }

/*
|--------------------------------------------------------------------------
| ADMIN MEMPROSES PENYEWAAN
|--------------------------------------------------------------------------
*/

public function processRental(Rental $rental)
{
    // Status rental harus disetujui
    if ($rental->status != 'disetujui') {

        return back()->with(
            'error',
            'Penyewaan belum disetujui.'
        );

    }

    // Pembayaran harus minimal Deposit Diterima atau Lunas
    if (!in_array($rental->payment->status, [
    'Deposit Diterima',
    'Lunas',
    'Cash Saat Pengambilan'
])) {

    return back()->with(
        'error',
        'Pembayaran belum dapat diproses.'
    );

}

    $rental->update([
        'status' => 'diproses',
    ]);

    Notification::create([
        'user_id' => $rental->user_id,
        'title' => 'Penyewaan Diproses',
        'message' => 'Admin sedang menyiapkan perlengkapan Anda.',
        'is_read' => false,
    ]);

    return back()->with(
        'success',
        'Penyewaan sedang diproses.'
    );
}

/*
|--------------------------------------------------------------------------
| BARANG SIAP DIKIRIM
|--------------------------------------------------------------------------
*/

public function shipRental(Rental $rental)
{
    if ($rental->status != 'diproses') {
        return back()->with(
            'error',
            'Pesanan belum diproses.'
        );
    }

    $rental->update([
        'status' => 'dikirim',
    ]);

    Notification::create([
        'user_id' => $rental->user_id,
        'title' => 'Barang Dikirim',
        'message' => 'Barang sedang dikirim ke alamat Anda.',
        'is_read' => false,
    ]);

    return back()->with(
        'success',
        'Barang berhasil dikirim.'
    );
}

/*
|--------------------------------------------------------------------------
| BARANG SIAP DIAMBIL
|--------------------------------------------------------------------------
*/

public function readyPickup(Rental $rental)
{
    if ($rental->status != 'diproses') {
        return back()->with(
            'error',
            'Pesanan belum diproses.'
        );
    }

    $rental->update([
        'status' => 'siap_diambil',
        'pickup_deadline' => Carbon::tomorrow(),
        'pickup_deadline_time' => '17:00',
    ]);

    Notification::create([
        'user_id' => $rental->user_id,
        'title' => 'Barang Siap Diambil',
        'message' => 'Barang dapat diambil maksimal besok pukul 17.00 WIB.',
        'is_read' => false,
    ]);

    return back()->with(
        'success',
        'Barang siap diambil.'
    );
}

/*
|--------------------------------------------------------------------------
| PENYEWAAN DIMULAI
|--------------------------------------------------------------------------
*/

public function startRental(Rental $rental)
{
    if (
        !in_array(
            $rental->status,
            ['dikirim', 'siap_diambil']
        )
    ) {
        return back()->with(
            'error',
            'Barang belum diterima pelanggan.'
        );
    }

    $today = Carbon::today();

    $rental->update([
        'status' => 'dipinjam',
        'rental_date' => $today,
        'return_date' => $today->copy()->addDays($rental->rental_days),
    ]);

    Notification::create([
        'user_id' => $rental->user_id,
        'title' => 'Penyewaan Dimulai',
        'message' => 'Selamat menikmati perlengkapan camping Anda.',
        'is_read' => false,
    ]);

    return back()->with(
        'success',
        'Penyewaan dimulai.'
    );
}

/*
|--------------------------------------------------------------------------
| DATA PENGEMBALIAN
|--------------------------------------------------------------------------
*/

public function returns()
{
    $rentals = Rental::with([
        'user',
        'payment',
        'rentalDetails.equipment'
    ])
    ->where('status', 'dipinjam')
    ->latest()
    ->get();

    return view('returns.index', compact('rentals'));
}

/*
|--------------------------------------------------------------------------
| PROSES PENGEMBALIAN
|--------------------------------------------------------------------------
*/

public function returnEquipment(Rental $rental)
{
    if ($rental->status != 'dipinjam') {
        return back()->with(
            'error',
            'Barang belum dipinjam.'
        );
    }

    DB::transaction(function () use ($rental) {

        foreach ($rental->rentalDetails as $detail) {

            if ($detail->equipment) {

                $detail->equipment->increment(
                    'stock',
                    $detail->quantity
                );
            }
        }

        // ==========================
        // HITUNG DENDA
        // ==========================

        $today = Carbon::today();

        $returnDate = Carbon::parse($rental->return_date);

        $lateDays = 0;
        $lateFee = 0;

        if ($today->gt($returnDate)) {

            $lateDays = $returnDate->diffInDays($today);

            $lateFee = $lateDays * 20000; // Rp20.000 per hari

        }

        // ==========================

        $rental->update([

            'status' => 'selesai',

            'returned_at' => $today,

            'late_days' => $lateDays,

            'late_fee' => $lateFee,

            'late_fee_status' => $lateFee > 0
                ? 'Belum Dibayar'
                : 'Belum Ada',

        ]);

        Notification::create([

            'user_id' => $rental->user_id,

            'title' => 'Penyewaan Selesai',

            'message' => $lateFee > 0
                ? 'Pengembalian selesai. Anda terlambat '.$lateDays.' hari dan dikenakan denda Rp '.number_format($lateFee,0,',','.')
                : 'Terima kasih telah menyewa di CampRent.',

            'is_read' => false,

        ]);
    });

    return redirect()
        ->route('returns.index')
        ->with(
            'success',
            'Pengembalian berhasil diproses.'
        );
}

/*
|--------------------------------------------------------------------------
| AUTO BATAL JIKA DP TIDAK DIBAYAR
|--------------------------------------------------------------------------
*/

public function cancelExpiredDeposit()
{
    $rentals = Rental::where('status', 'menunggu')
        ->where('deposit_status', 'belum_bayar')
        ->whereDate('deposit_deadline', '<', Carbon::today())
        ->get();

    foreach ($rentals as $rental) {

        DB::transaction(function () use ($rental) {

            foreach ($rental->rentalDetails as $detail) {

                if ($detail->equipment) {

                    $detail->equipment->increment(
                        'stock',
                        $detail->quantity
                    );

                }

            }

            $rental->update([
                'status' => 'dibatalkan'
            ]);

            if ($rental->payment) {

                $rental->payment->update([
                    'status' => 'Expired'
                ]);

            }

            Notification::create([
                'user_id' => $rental->user_id,
                'title'   => 'Pesanan Dibatalkan',
                'message' => 'Pesanan otomatis dibatalkan karena DP tidak dibayar sebelum batas waktu.',
                'is_read' => false
            ]);

        });

    }

    return back()->with(
        'success',
        'Pengecekan deposit selesai.'
    );
}

}