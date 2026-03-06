<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardKepalaPerpusController extends Controller
{
  
    // Jumlah keseluruhan anggota
    private function jumlahAnggota()
    {
        return User::where('role', 'anggota')->count();
    }

    // Jumlah keseluruhan petugas
    private function jumlahPetugas()
    {
        return User::where('role', 'petugas')->count();
    }

    // Dashboard Kepala Perpustakaan
    public function Dashboard_Kepala_Perpustakaan()
    {
        return view('Kepala_perpus.dashboard', [
            "Jumlah_Anggota" => $this->jumlahAnggota(),
            "Jumlah_Petugas" => $this->jumlahPetugas()
        ]);
    }
}
