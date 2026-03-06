<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KepalaPerpus extends Model
{
    protected $table = 'kepala_perpus';
    protected $guarded = [];

    // Relasi Kepala Dan User
    public function user()
    {
        // Satu Kepala Hanya Punya Satu User
        return $this->belongsTo(User::class, 'user_id');
    }
}
