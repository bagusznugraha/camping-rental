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

    $table->date('returned_at')->nullable();

    $table->integer('late_days')->default(0);

    $table->decimal('late_fee',12,2)->default(0);

    $table->enum('late_fee_status',[
        'Belum Ada',
        'Belum Dibayar',
        'Lunas'
    ])->default('Belum Ada');

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rentals', function (Blueprint $table) {
            //
        });
    }
};
