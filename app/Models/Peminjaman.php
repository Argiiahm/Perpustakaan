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
    public function petugas() {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }


    public function buku() {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function riwayat_konfirmasi_pengajuan() {
        return $this->hasMany(RiwayatPengajuan::class);
    }

    public function pengembalian() {
        return $this->hasOne(Pengembalian::class, 'peminjam_id');
    }

}
