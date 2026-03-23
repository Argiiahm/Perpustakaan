<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';
    protected $guarded = [];

    // Relasi Anggota Dan User
    public function user()
    {
        // Satu Anggota Hanya Punya Satu User
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi Anggota Dengan Peminjaman Buku
    public function peminjaman_buku() {
        // satu anggota bisa pinjam lebih dari 1
        return $this->hasMany(Peminjaman::class);
    }

    // Relasi ke Notifikasi Atau Pemberitahuan
    public function pemberitahuan() {
        return $this->hasMany(Pemberitahuan::class);
    }

}
