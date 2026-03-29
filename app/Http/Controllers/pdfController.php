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
    public function cetakPengajuan(Request $request)
    {
        $nama = Auth::user()->Petugas->nama_lengkap ?? Auth::user()->username;
        $jenis_aktivitas = $request->input('jenis_aktivitas', 'pengajuan');

        if ($jenis_aktivitas === 'pengembalian') {
            $query = Pengembalian::with(['peminjaman.buku', 'peminjaman.anggota'])
                ->where('status', 'dikembalikan')
                ->whereHas('peminjaman', function ($q) {
                    $q->where('petugas_id', Auth::user()->petugas->id);
                });
        } else {
            $query = RiwayatPengajuan::with('peminjaman')
                ->whereHas('peminjaman', function ($q) {
                    $q->where('petugas_id', Auth::user()->petugas->id);
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

        $aktivitas_data = $query->latest()->get();
        $namaFile = Str::slug($nama);

        if ($jenis_aktivitas === 'pengembalian') {
            $pdf = Pdf::loadView('pdf.pengembalian', [
                "aktivitas_data" => $aktivitas_data
            ]);
            return $pdf->download('pengembalian-konfirmasi-' . $namaFile . '.pdf');
        } else {
            $pdf = Pdf::loadView('pdf.pengajuan', [
                "pengajuans_konfirmasi" => $aktivitas_data
            ]);
            return $pdf->download('pengajuan-konfirmasi-' . $namaFile . '.pdf');
        }
    }
}
