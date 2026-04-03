<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
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
        // Ambil Jumlah User dengan Role Anggota
        return User::where('role', 'anggota')->count();
    }

    // Jumlah keseluruhan petugas
    private function jumlahPetugas()
    {
        // Ambil Jumlah User dengan Role Petugas
        return User::where('role', 'petugas')->count();
    }

    // Jumlah keseluruhan Buku
    private function jumlahBuku()
    {
        // Ambil Jumlah Buku
        return Buku::count();
    }

    // Jumlah keseluruhan peminjaman
    private function jumlahPeminjaman()
    {
        // Ambil Jumlah Peminjaman dengan Status Dipinjam
         $peminjaman = Peminjaman::where('status', 'dipinjam')->count();
         return $peminjaman;
    }

    // Jumlah keseluruhan pengembalian
    private function jumlahPengembalian()
    {
        // Ambil Jumlah Pengembalian dengan Status Dikembalikan
        $pengembalian = Pengembalian::where('status', 'dikembalikan')
            ->count();
         return $pengembalian;
    }


    // Dashboard Kepala Perpustakaan
    public function Dashboard_Kepala_Perpustakaan()
    {
        return view('Kepala_perpus.dashboard', [
            "Jumlah_Anggota" => $this->jumlahAnggota(),
            "Jumlah_Petugas" => $this->jumlahPetugas(),
            "jumlah_buku"    => $this->jumlahBuku(),
            "jumlah_peminjaman" => $this->jumlahPeminjaman(),
            "jumlah_pengembalian"  =>  $this->jumlahPengembalian()
        ]);
    }

    // Daftar Transaksi
    public function daftar_transaksi(Request $request)
    {
        // Ambil Jenis Transaksi dari Request
        $jenis_transaksi = $request->input('jenis_transaksi', 'pengajuan');

        // Ambil Data Transaksi Berdasarkan Jenis Transaksi
        if ($jenis_transaksi === 'pengembalian') {
            // Jika Jenis Transaksi Pengembalian, Ambil Data Pengembalian Beserta Relasi Peminjaman dan Anggota
            $query = Pengembalian::with(['peminjaman.buku', 'peminjaman.anggota'])
                ->where('status', 'dikembalikan');
        } else {
            // Jika Jenis Transaksi Pengajuan, Ambil Data Pengajuan Beserta Relasi Peminjaman
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

        // Ambil Data Transaksi Berdasarkan Filter Waktu
        $transaksis = $query->latest()->get();

        return view('Kepala_perpus.daftar-transaksi', [
            "transaksis"   => $transaksis,
            "jenis_transaksi"  => $jenis_transaksi
        ]);
    }
}
