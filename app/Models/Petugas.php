<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $guarded = [];

    // Relasi Petugas Dan User
    public function user()
    {
        // Satu Petuvas Hanya Punya Satu User
        return $this->belongsTo(User::class, 'user_id');
    }
}
