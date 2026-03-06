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

    public function peminjaman_buku() {
        // return $this->hasMany();
    }

}
