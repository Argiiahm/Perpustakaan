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
            if (!Schema::hasColumn('pengembalian_buku', 'status_pembayaran')) {
                $table->string('status_pembayaran')->nullable()->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengembalian_buku', function (Blueprint $table) {
            if (Schema::hasColumn('pengembalian_buku', 'status_pembayaran')) {
                $table->dropColumn('status_pembayaran');
            }
        });
    }
};
