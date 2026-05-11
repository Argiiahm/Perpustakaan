<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anggota', function (Blueprint $table) {
            $table->integer('total_pinjam_sekarang')->nullable()->default(0)->after('alamat');
            $table->integer('total_denda')->nullable()->default(0)->after('total_pinjam_sekarang');
        });
    }

    public function down(): void
    {
        Schema::table('anggota', function (Blueprint $table) {
            $table->dropColumn('total_pinjam_sekarang');
            $table->dropColumn('total_denda');
        });
    }
};
