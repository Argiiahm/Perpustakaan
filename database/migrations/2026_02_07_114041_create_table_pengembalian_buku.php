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
        Schema::create('pengembalian_buku', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'peminjam_id')->constrained('peminjam_buku')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('jumlah_denda')->default(0);
            $table->enum('status',['tepat_waktu','jatuh_tempo']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalian_buku');
    }
};
