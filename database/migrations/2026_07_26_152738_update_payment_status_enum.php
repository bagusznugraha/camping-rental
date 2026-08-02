<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE payments
            MODIFY status ENUM(
                'Belum Bayar',
                'Menunggu Verifikasi',
                'Menunggu Verifikasi Pelunasan',
                'Deposit Diterima',
                'Lunas',
                'Ditolak'
            ) NOT NULL DEFAULT 'Belum Bayar'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE payments
            MODIFY status ENUM(
                'Belum Bayar',
                'Menunggu Verifikasi',
                'Diterima',
                'Ditolak'
            ) NOT NULL DEFAULT 'Belum Bayar'
        ");
    }
};