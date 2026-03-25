<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengembalian_buku', function (Blueprint $table) {
            $table->string('status')->change();
            $table->string('total_hari_terlambat')->nullable()->after('peminjam_id');
            $table->integer('total_bayar')->nullable()->after('jumlah_denda');
            $table->integer('jumlah_bayar')->nullable()->after('total_bayar');
            $table->integer('jumlah_kembalian')->nullable()->after('jumlah_bayar');
        });
    }

    public function down(): void
    {
        Schema::table('pengembalian_buku', function (Blueprint $table) {
            $table->enum('status', ['tepat_waktu', 'jatuh_tempo'])->change();
            $table->dropColumn([
                'total_hari_terlambat',
                'jumlah_bayar',
                'jumlah_kembalian'
            ]);
        });
    }
};
