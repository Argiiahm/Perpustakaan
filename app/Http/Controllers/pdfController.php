<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Models\RiwayatPengajuan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class pdfController extends Controller
{
    // Cetak PDF Pengajuan
    public function cetakPengajuan(Request $request)
    {
        // Ambil Nama Petugas
        $nama = Auth::user()->Petugas->nama_lengkap ?? Auth::user()->username;

        // Ambil Jenis Aktivitas
        $jenis_aktivitas = $request->input('jenis_aktivitas', 'pengajuan');

        // Ambil Data Pengajuan atau Pengembalian Berdasarkan Jenis Aktivitas
        if ($jenis_aktivitas === 'pengembalian') {
            // Jika Jenis Aktivitas Pengembalian, Ambil Data Pengembalian Beserta Relasi Peminjaman dan Anggota
            $query = Pengembalian::with(['peminjaman.buku', 'peminjaman.anggota'])
                ->where('status', 'dikembalikan')
                ->whereHas('peminjaman', function ($q) {
                    $q->where('petugas_id', Auth::user()->petugas->id ?? null);
                });
        } else {
            // Jika Jenis Aktivitas Pengajuan, Ambil Data Pengajuan Beserta Relasi Peminjaman
            $query = RiwayatPengajuan::with('peminjaman')
                ->whereHas('peminjaman', function ($q) {
                    $q->where('petugas_id', Auth::user()->petugas->id ?? null);
                });
        }

        // Filter Waktu
        if ($request->filter_waktu) {
            $dateColumn = ($jenis_aktivitas === 'pengembalian') ? 'updated_at' : 'created_at';

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

        // Ambil Data Aktivitas Berdasarkan Filter Waktu
        $aktivitas_data = $query->latest()->get();
        // Buat Nama File PDF Berdasarkan Nama Petugas dan Jenis Aktivitas
        $namaFile = Str::slug($nama);
        // Generate PDF Berdasarkan Jenis Aktivitas
        if ($jenis_aktivitas === 'pengembalian') {
            // Jika Jenis Aktivitas Pengembalian, Generate PDF dengan View pdf.pengembalian
            $pdf = Pdf::loadView('pdf.pengembalian', [
                "aktivitas_data" => $aktivitas_data
            ]);
            return $pdf->download('pengembalian-konfirmasi-' . $namaFile . '.pdf');
        } else {
            // Jika Jenis Aktivitas Pengajuan, Generate PDF dengan View pdf.pengajuan
            $pdf = Pdf::loadView('pdf.pengajuan', [
                "pengajuans_konfirmasi" => $aktivitas_data
            ]);
            return $pdf->download('pengajuan-konfirmasi-' . $namaFile . '.pdf');
        }
    }

    // Cetak Transaksi untuk Kepala Perpus
    public function cetakTransaksi(Request $request)
    {
        // Ambil Jenis Transaksi
        $jenis_transaksi = $request->input('jenis_transaksi', 'pengajuan');

        // Ambil Data Transaksi Berdasarkan Jenis Transaksi
        if ($jenis_transaksi === 'pengembalian') {
            // Jika Jenis Transaksi Pengembalian, Ambil Data Pengembalian Beserta Relasi Peminjaman dan Anggota
            $query = Pengembalian::with(['peminjaman.buku', 'peminjaman.anggota'])
                ->where('status', 'dikembalikan');
        } else {
            // Jika Jenis Transaksi Pengajuan, Ambil Data Pengajuan Beserta Relasi Peminjaman
            $query = RiwayatPengajuan::with('peminjaman');
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
        $aktivitas_data = $query->latest()->get();

        if ($jenis_transaksi === 'pengembalian') {
            // Jika Jenis Transaksi Pengembalian, Generate PDF dengan View pdf.transaksi-pengembalian
            $pdf = Pdf::loadView('pdf.transaksi-pengembalian', [
                "aktivitas_data" => $aktivitas_data
            ]);
            return $pdf->download('pengembalian-konfirmasi' . '.pdf');
        } else {
            // Jika Jenis Transaksi Pengajuan, Generate PDF dengan View pdf.transaksi-pengajuan
            $pdf = Pdf::loadView('pdf.transaksi-pengajuan', [
                "pengajuans_konfirmasi" => $aktivitas_data
            ]);
            return $pdf->download('pengajuan-konfirmasi-' . '.pdf');
        }
    }
}
