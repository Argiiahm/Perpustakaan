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
            if (!Schema::hasColumn('pengembalian_buku', 'buku_rusak')) {
                $table->boolean('buku_rusak')->default(false)->after('peminjam_id');
            }

            if (!Schema::hasColumn('pengembalian_buku', 'buku_hilang')) {
                $table->boolean('buku_hilang')->default(false)->after('buku_rusak');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengembalian_buku', function (Blueprint $table) {
            if (Schema::hasColumn('pengembalian_buku', 'buku_rusak')) {
                $table->dropColumn('buku_rusak');
            }

            if (Schema::hasColumn('pengembalian_buku', 'buku_hilang')) {
                $table->dropColumn('buku_hilang');
            }
        });
    }
};
