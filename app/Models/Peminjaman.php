<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjam_buku';
    protected $guarded = [];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id');
    }


    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function riwayat_konfirmasi_pengajuan()
    {
        return $this->hasMany(RiwayatPengajuan::class);
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'peminjam_id');
    }

    // untuk menghitung sisa hari sebelum jatuh tempo
    public function getSisaHariAttribute()
    {
        if (!$this->tanggal_jatuh_tempo) return null;

        return now()->startOfDay()->diffInDays(
            Carbon::parse($this->tanggal_jatuh_tempo)->startOfDay(),
            false
        );
    }
}
