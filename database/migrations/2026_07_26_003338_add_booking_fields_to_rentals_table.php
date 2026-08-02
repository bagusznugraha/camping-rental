<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rentals', function (Blueprint $table) {

            // tanggal booking dibuat tetap memakai created_at

            $table->date('start_date')
      ->nullable()
      ->after('user_id');

            $table->decimal('deposit_amount', 12, 2)->default(0);

            $table->decimal('remaining_payment', 12, 2)->default(0);

            $table->date('deposit_deadline')->nullable();

            $table->enum('deposit_status', [
                'belum_bayar',
                'menunggu_verifikasi',
                'lunas',
                'kadaluarsa'
            ])->default('belum_bayar');

        });
    }

    public function down(): void
    {
        Schema::table('rentals', function (Blueprint $table) {

            $table->dropColumn([
                'start_date',
                'deposit_amount',
                'remaining_payment',
                'deposit_deadline',
                'deposit_status',
            ]);

        });
    }
};