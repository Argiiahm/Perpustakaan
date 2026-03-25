<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalian_buku';
    protected $guarded = [];

    public function peminjaman() {
        return $this->belongsTo(Pengembalian::class, 'peminjam_id');
    }

}
