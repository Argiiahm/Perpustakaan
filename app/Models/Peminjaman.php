<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjam_buku';
    protected $guarded = [];

    public function anggota() {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function buku() {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function riwayat_konfirmasi_pengajuan() {
        return $this->hasMany(RiwayatPengajuan::class);
    }

}
