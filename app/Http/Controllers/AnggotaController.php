<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaController extends Controller
{
    // Menghitung Presentase Kelengkapan Profile Anggota
    private function calculatePresentase()
    {
        $anggota = Auth::user();
        // dd($anggota);

        // Presentase Kelengkapan Profile
        // General (username, email, telepon)
        if ($anggota->username && $anggota->email && $anggota->no_telepon) {
            $general = 30;
        } else {
            $general = 0;
        }
        // Foto
        if ($anggota->profile_photo) {
            $foto = 20;
        } else {
            $foto = 0;
        }
        // Nama anggota
        $nama_lengkap = optional($anggota->anggota)->nama_lengkap ? 10 : 0;
        // Nomor induk
        $nomer_induk = optional($anggota->anggota)->nomer_induk ? 10 : 0;
        // Jenis kelamin
        $jk = optional($anggota->anggota)->jenis_kelamin ? 10 : 0;
        // Tanggal lahir
        $tgl_lahir = optional($anggota->anggota)->tanggal_lahir ? 10 : 0;
        // Alamat
        $alamat = optional($anggota->anggota)->alamat ? 10 : 0;

        // Presentase
        $presentase = $general + $foto + $nama_lengkap + $nomer_induk + $jk + $tgl_lahir + $alamat;
        return $presentase;
        // End Presentase Kelengkapan Profile
    }


    // Menampilkan Dashboard Anggota
    public function Dashboard_Anggota()
    {
        return view('Anggota.dashboard', [
            "Presentase"   =>    $this->calculatePresentase()
        ]);
    }

    // Halaman Riwayat Pinjaman
    public function riwayat_pinjaman() {
        return view('Anggota.riwayat-pinjaman');
    }

    // Halaman Daftar Buku
    public function daftar_buku() {
        $Bukus = Buku::paginate(2);
        return view('Anggota.daftar-buku',[
            "Bukus"   =>    $Bukus
        ]);
    }

    // Detail Buku
    public function detail_buku(Buku $buku) {
        // dd($buku);
        return view('Anggota.detail-buku',[
            "buku"   =>    $buku
        ]);
    }
}
