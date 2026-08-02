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
        Schema::table('equipment', function (Blueprint $table) {

            // Spesifikasi barang
            $table->text('specification')
                  ->nullable()
                  ->after('description');

            // Total pelanggan yang pernah menyewa barang ini
            $table->unsignedInteger('rent_count')
                  ->default(0)
                  ->after('stock');

            // Daya lampu (untuk alat lampu)
            $table->string('watt')
                  ->nullable()
                  ->after('specification');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipment', function (Blueprint $table) {

            $table->dropColumn([
                'specification',
                'rent_count',
                'watt',
            ]);

        });
    }
};