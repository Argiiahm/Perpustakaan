<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'setting';

    protected $fillable = [
        'max_pinjam',
        'max_pengajuan',
        'denda_per_hari',
        'tanggal_jatuh_tempo'
    ];
}
