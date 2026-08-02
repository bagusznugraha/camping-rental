<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Payment;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN PEMBAYARAN PELANGGAN
    |--------------------------------------------------------------------------
    */

    public function show()
    {
        $rental = Rental::with([
            'payment',
            'rentalDetails.equipment'
        ])
        ->where('user_id', auth()->id())
        ->latest()
        ->first();

        if (!$rental) {
            return redirect()
                ->route('customer.equipment')
                ->with('error', 'Belum ada penyewaan.');
        }

        return view('payment.show', compact('rental'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPLOAD PEMBAYARAN AWAL
    |--------------------------------------------------------------------------
    */

    public function upload(Request $request, Rental $rental)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $payment = $rental->payment;

        if (!$payment) {
            return back()->with('error', 'Data pembayaran tidak ditemukan.');
        }

        if ($payment->payment_proof) {
            Storage::disk('public')->delete($payment->payment_proof);
        }

        $path = $request->file('payment_proof')
            ->store('payments', 'public');

        $payment->update([
            'payment_proof' => $path,
            'status' => 'Menunggu Verifikasi',
        ]);

        Notification::create([
            'user_id' => $rental->user_id,
            'title' => 'Bukti Pembayaran Dikirim',
            'message' => 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.',
            'is_read' => false,
        ]);

        return back()->with(
            'success',
            'Bukti pembayaran berhasil dikirim.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPLOAD PELUNASAN
    |--------------------------------------------------------------------------
    */

    public function uploadRemaining(Request $request, Rental $rental)
{
    $request->validate([
        'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $payment = $rental->payment;

    if (!$payment) {
        return back()->with('error', 'Data pembayaran tidak ditemukan.');
    }

    $path = $request->file('payment_proof')
        ->store('payments', 'public');

    if ($payment->payment_type == 'full') {

        // hapus bukti lama
        if ($payment->payment_proof) {
            Storage::disk('public')->delete($payment->payment_proof);
        }

        $payment->update([
    'payment_proof' => $path,
    'status' => 'Menunggu Verifikasi',
    'admin_note' => null,
]);

    } else {

        // remaining
        if ($payment->remaining_payment_proof) {
            Storage::disk('public')->delete($payment->remaining_payment_proof);
        }

        $payment->update([
            'remaining_payment_proof' => $path,
            'status' => 'Menunggu Verifikasi Pelunasan',
            'admin_note' => null,
        ]);
    }

    Notification::create([
        'user_id' => $rental->user_id,
        'title' => 'Bukti Pembayaran Dikirim',
        'message' => 'Bukti pembayaran berhasil dikirim dan sedang menunggu verifikasi admin.',
        'is_read' => false,
    ]);

    return back()->with('success', 'Bukti pembayaran berhasil dikirim.');
}

    /*
    |--------------------------------------------------------------------------
    | DAFTAR PEMBAYARAN ADMIN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $payments = Payment::with([
            'rental.user'
        ])
        ->latest()
        ->get();

        return view('payments.index', compact('payments'));
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function detail(Payment $payment)
    {
        $payment->load([
            'rental.user',
            'rental.payment',
            'rental.rentalDetails.equipment',
        ]);

        return view('payments.show', compact('payment'));
    }

    /*
    |--------------------------------------------------------------------------
    | VERIFIKASI PEMBAYARAN
    |--------------------------------------------------------------------------
    */
        public function approve(Payment $payment)
    {
        DB::transaction(function () use ($payment) {

            $rental = $payment->rental;

            /*
            |--------------------------------------------------------------------------
            | VERIFIKASI PEMBAYARAN AWAL
            |--------------------------------------------------------------------------
            */

            if ($payment->status == 'Menunggu Verifikasi') {

                /*
                |--------------------------------------------------------------------------
                | PEMBAYARAN DEPOSIT
                |--------------------------------------------------------------------------
                */

                if ($payment->payment_type == 'deposit') {

                    $payment->update([
                        'status' => 'Deposit Diterima',
                    ]);

                    $rental->update([
                        'deposit_status' => 'lunas',
                        'deposit_paid_at' => now(),
                        'status' => 'disetujui',
                    ]);

                    Notification::create([
                        'user_id' => $rental->user_id,
                        'title' => 'Deposit Diterima',
                        'message' => 'Deposit telah diterima. Silakan lakukan pelunasan sebelum tanggal mulai sewa.',
                        'is_read' => false,
                    ]);
                }

                /*
                |--------------------------------------------------------------------------
                | PEMBAYARAN LUNAS
                |--------------------------------------------------------------------------
                */

                else {

    $payment->update([
        'status' => 'Lunas',
        'amount_paid' => $payment->amount,
        'remaining_amount' => 0,
    ]);

    $rental->update([
        'deposit_status' => 'lunas',
        'deposit_paid_at' => now(),
        'remaining_payment' => 0,
    ]);

    if ($rental->status != 'diproses') {

        $rental->update([
            'status' => 'disetujui',
        ]);

    }

                    Notification::create([
                        'user_id' => $rental->user_id,
                        'title' => 'Pembayaran Diterima',
                        'message' => 'Pembayaran Anda telah diverifikasi. Pesanan siap diproses admin.',
                        'is_read' => false,
                    ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | VERIFIKASI PELUNASAN
            |--------------------------------------------------------------------------
            */

            elseif ($payment->status == 'Menunggu Verifikasi Pelunasan') {

                $payment->update([
                    'status' => 'Lunas',
                    'amount_paid' => $payment->amount,
                    'remaining_amount' => 0,
                ]);

                $rental->update([
    'deposit_status' => 'lunas',
    'remaining_payment' => 0,
]);

if ($rental->status != 'diproses') {
    $rental->update([
        'status' => 'disetujui',
    ]);
}


                Notification::create([
                    'user_id' => $rental->user_id,
                    'title' => 'Pelunasan Diterima',
                    'message' => 'Pelunasan berhasil diverifikasi. Pesanan siap diproses admin.',
                    'is_read' => false,
                ]);
            }

        });

        return back()->with(
            'success',
            'Pembayaran berhasil diverifikasi.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TOLAK PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function reject(Request $request, Payment $payment)
    {
        $request->validate([
            'admin_note' => 'required',
        ]);

        $payment->update([
            'status' => 'Ditolak',
            'admin_note' => $request->admin_note,
        ]);

        Notification::create([
            'user_id' => $payment->rental->user_id,
            'title' => 'Pembayaran Ditolak',
            'message' => 'Bukti pembayaran ditolak. Silakan upload ulang bukti pembayaran.',
            'is_read' => false,
        ]);

        return back()->with(
            'success',
            'Pembayaran berhasil ditolak.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PEMBAYARAN CASH
    |--------------------------------------------------------------------------
    */
        public function cashPayment(Payment $payment)
    {
        DB::transaction(function () use ($payment) {

            $payment->update([
                'status' => 'Lunas',
                'amount_paid' => $payment->amount,
                'remaining_amount' => 0,
            ]);

            $payment->rental->update([
    'deposit_status' => 'lunas',
    'remaining_payment' => 0,
]);



            Notification::create([
                'user_id' => $payment->rental->user_id,
                'title' => 'Pembayaran Cash Diterima',
                'message' => 'Pembayaran cash telah diterima oleh admin.',
                'is_read' => false,
            ]);

        });

        return back()->with(
            'success',
            'Pembayaran cash berhasil diterima.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PERMINTAAN BAYAR CASH
    |--------------------------------------------------------------------------
    */

    public function cashRequest(Rental $rental)
{
    $payment = $rental->payment;

    $payment->update([

        'status' => 'Cash Saat Pengambilan',

    ]);

    Notification::create([

        'user_id' => 1, // admin

        'title' => 'Permintaan Bayar Cash',

        'message' => $rental->user->name .
            ' memilih pelunasan cash saat pengambilan.',

        'is_read' => false,

    ]);

    return back()->with(
        'success',
        'Permintaan pembayaran cash berhasil dikirim.'
    );
}
}