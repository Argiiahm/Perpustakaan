<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class KelolaPenggunaController extends Controller
{
    public function daftar_pengguna()
    {
        return view('Kepala_perpus.daftar-pengguna', [
            "Users"    =>    User::all()
        ]);
    }

    public function cari_pengguna(Request $request)
    {
        $cari = $request->input('cari');

        $users = User::where(function ($query) use ($cari) {

            $query->where('username', 'like', "%{$cari}%")
                ->orWhere('email', 'like', "%{$cari}%")

                ->orWhereHas('anggota', function ($q) use ($cari) {
                    $q->where('nama_lengkap', 'like', "%{$cari}%")
                        ->orWhere('nomer_induk', 'like', "%{$cari}%");
                })

                // ->orWhereHas('petugas', function ($q) use ($cari) {
                //     $q->where('nama_lengkap', 'like', "%{$cari}%")
                //         ->orWhere('nomer_induk', 'like', "%{$cari}%");
                // })

                ->orWhereHas('KepalaPerpus', function ($q) use ($cari) {
                    $q->where('nama_lengkap', 'like', "%{$cari}%")
                        ->orWhere('nomer_induk', 'like', "%{$cari}%");
                });
        })->get();

        return view('Kepala_perpus.daftar-pengguna', [
            "Users" => $users
        ]);
    }
}
