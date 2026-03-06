<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardAnggotaController extends Controller
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
}
