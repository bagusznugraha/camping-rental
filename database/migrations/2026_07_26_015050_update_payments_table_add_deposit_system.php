<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {

            // pelanggan memilih bayar deposit atau langsung lunas
            $table->enum('payment_type', [
                'deposit',
                'full'
            ])->default('deposit');

            // total yang harus dibayar saat ini
            $table->decimal('amount_paid',12,2)->default(0);

            // sisa pembayaran
            $table->decimal('remaining_amount',12,2)->default(0);

            // batas pembayaran deposit
            $table->date('deposit_deadline')->nullable();

            // bukti pembayaran pelunasan
            $table->string('final_payment_proof')->nullable();

            // status pelunasan
            $table->enum('final_payment_status',[
                'Belum Bayar',
                'Menunggu Verifikasi',
                'Diterima',
                'Ditolak'
            ])->default('Belum Bayar');

        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {

            $table->dropColumn([
                'payment_type',
                'amount_paid',
                'remaining_amount',
                'deposit_deadline',
                'final_payment_proof',
                'final_payment_status'
            ]);

        });
    }
};