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
            $table->date('tanggal_kembalikan')->nullable()->after('jumlah_kembalian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengembalian_buku', function (Blueprint $table) {
            $table->dropColumn('tanggal_kembalikan');
        });
    }
};
