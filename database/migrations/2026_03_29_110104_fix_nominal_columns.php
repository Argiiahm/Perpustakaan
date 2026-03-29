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
        Schema::table('pengembalian_buku', function (Blueprint $table) {
            $table->bigInteger('total_bayar')->nullable()->change();
            $table->bigInteger('jumlah_bayar')->nullable()->change();
            $table->bigInteger('jumlah_kembalian')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
