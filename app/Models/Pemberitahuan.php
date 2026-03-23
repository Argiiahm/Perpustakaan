<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemberitahuan extends Model
{
    protected $table = 'notifikasi';
    protected $guarded = [];

    public function anggota() {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
}
