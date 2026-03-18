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
        Schema::create('peminjam_buku', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buku_id')->constrained('buku')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('anggota_id')->constrained('anggota')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('petugas_id')->nullable()->constrained('petugas')->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->enum('status',['menunggu','dipinjam','ditolak','dikembalikan'])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjam_buku');
    }
};
