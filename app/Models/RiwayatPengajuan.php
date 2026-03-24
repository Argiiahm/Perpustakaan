<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPengajuan extends Model
{
    protected $table = 'riwayat_pengajuans';
    protected $guarded = [];

    public function peminjaman() {
        return $this->belongsTo(Peminjaman::class, 'peminjam_id');
    }
}
