<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class KelolaPenggunaController extends Controller
{
    public function daftar_pengguna(Request $request)
    {   
        // Searcing
        $cari = $request->input('cari');

        $users = User::where(function ($query) use ($cari) {

            $query->where('username', 'like', "%{$cari}%")
                ->orWhere('email', 'like', "%{$cari}%")

                // Anggota
                ->orWhereHas('anggota', function ($q) use ($cari) {
                    $q->where('nama_lengkap', 'like', "%{$cari}%")
                        ->orWhere('nomer_induk', 'like', "%{$cari}%");
                })

                // ->orWhereHas('petugas', function ($q) use ($cari) {
                //     $q->where('nama_lengkap', 'like', "%{$cari}%")
                //         ->orWhere('nomer_induk', 'like', "%{$cari}%");
                // })

                // Kpala Perpus
                ->orWhereHas('KepalaPerpus', function ($q) use ($cari) {
                    $q->where('nama_lengkap', 'like', "%{$cari}%")
                        ->orWhere('nomer_induk', 'like', "%{$cari}%");
                });
        })->paginate(6)
        // Paginasi
            ->withQueryString();

        return view('Kepala_perpus.daftar-pengguna', [
            "Users"    =>    $users
        ]);
        
    }

    public function detail_pengguna(User $user) {
        return view('Kepala_perpus.detail-pengguna',[
            "User"   =>   $user
        ]);
    }

    public function tambah_pengguna_index() {
        return view('Kepala_perpus.tambah-pengguna');
    }
}
