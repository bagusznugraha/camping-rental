<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('rentals', function (Blueprint $table) {

            // Lama sewa
            $table->integer('rental_days')->after('return_date');

            // Data pelanggan
            $table->string('phone')->after('rental_days');
            $table->text('address')->after('phone');

            // Metode pengambilan
            $table->enum('pickup_method', [
                'Diambil',
                'Dikirim'
            ])->default('Diambil')->after('address');

            // Ongkir
            $table->decimal('delivery_fee',10,2)
                ->default(0)
                ->after('pickup_method');

            // Metode pembayaran
            $table->string('payment_method')
                ->nullable()
                ->after('delivery_fee');

            // Bukti pembayaran
            $table->string('payment_proof')
                ->nullable()
                ->after('payment_method');

            // Status pembayaran
            $table->enum('payment_status',[
                'Belum Bayar',
                'Menunggu Verifikasi',
                'Diterima',
                'Ditolak'
            ])->default('Belum Bayar')
              ->after('payment_proof');

            // Batas pengambilan
            $table->date('pickup_deadline')
                ->nullable()
                ->after('payment_status');

            $table->time('pickup_deadline_time')
                ->nullable()
                ->after('pickup_deadline');

            // Catatan admin
            $table->text('admin_note')
                ->nullable()
                ->after('pickup_deadline_time');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rentals', function (Blueprint $table) {

            $table->dropColumn([
                'rental_days',
                'phone',
                'address',
                'pickup_method',
                'delivery_fee',
                'payment_method',
                'payment_proof',
                'payment_status',
                'pickup_deadline',
                'pickup_deadline_time',
                'admin_note',
            ]);

        });
    }
};