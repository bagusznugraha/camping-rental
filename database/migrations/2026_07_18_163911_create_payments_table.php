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
        Schema::create('payments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('rental_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('payment_method');

            $table->string('payment_proof')->nullable();

            $table->enum('status',[
    'Belum Bayar',
    'Menunggu Verifikasi',
    'Menunggu Verifikasi Pelunasan',
    'Deposit Diterima',
    'Lunas',
    'Ditolak'
])->default('Belum Bayar');

            $table->decimal('amount',12,2);

            $table->text('admin_note')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};