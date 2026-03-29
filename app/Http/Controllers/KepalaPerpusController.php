<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Pengembalian;
use App\Models\RiwayatPengajuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KepalaPerpusController extends Controller
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

    // Jumlah keseluruhan Buku
    private function jumlahBuku()
    {
        return Buku::count();
    }

    // Dashboard Kepala Perpustakaan
    public function Dashboard_Kepala_Perpustakaan()
    {
        return view('Kepala_perpus.dashboard', [
            "Jumlah_Anggota" => $this->jumlahAnggota(),
            "Jumlah_Petugas" => $this->jumlahPetugas(),
            "jumlah_buku"    => $this->jumlahBuku()
        ]);
    }

    // Daftar Transaksi
    public function daftar_transaksi(Request $request)
    {
        $jenis_transaksi = $request->input('jenis_transaksi', 'pengajuan');

        if ($jenis_transaksi === 'pengembalian') {
            $query = Pengembalian::with(['peminjaman.buku', 'peminjaman.anggota'])
                ->where('status', 'dikembalikan');
        } else {
            $query = RiwayatPengajuan::with(['peminjaman.buku', 'peminjaman.anggota']);
        }

        // Filter Waktu
        if ($request->filter_waktu) {
            $dateColumn = ($jenis_transaksi === 'pengembalian') ? 'updated_at' : 'created_at';

            // Filter Minggu ini
            if ($request->filter_waktu === 'minggu_ini') {
                $query->whereBetween($dateColumn, [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ]);
            }

            // Filter Bulan Ini
            if ($request->filter_waktu == 'bulan_ini') {
                $query->whereMonth($dateColumn, now()->month)
                    ->whereYear($dateColumn, now()->year);
            }

            // Bulan Lalu
            if ($request->filter_waktu == 'bulan_lalu') {
                $lastMonth = now()->subMonthNoOverflow();

                $query->whereMonth($dateColumn, $lastMonth->month)
                    ->whereYear($dateColumn, $lastMonth->year);
            }
        }

        $transaksis = $query->latest()->get();

        return view('Kepala_perpus.daftar-transaksi', [
            "transaksis"   => $transaksis,
            "jenis_transaksi"  => $jenis_transaksi
        ]);
    }
}
