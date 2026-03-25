<?php

namespace App\Http\Controllers;

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

        $query = RiwayatPengajuan::with('peminjaman')
            ->whereHas('peminjaman', function ($q) {
                $q->where('petugas_id', Auth::user()->petugas->id);
            });

        // Filter Waktu
        if ($request->filter_waktu) {
            // Filter Minngu ini
            if ($request->filter_waktu === 'minggu_ini') {
                $query->whereBetween('created_at', [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ]);
            }

            // Filter Bulan Ini
            if ($request->filter_waktu == 'bulan_ini') {
                $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
            }

            // Bulan Lalu
            if ($request->filter_waktu == 'bulan_lalu') {
                $lastMonth = now()->subMonth();

                $query->whereMonth('created_at', $lastMonth->month)
                    ->whereYear('created_at', $lastMonth->year);
            }
        }

        $pengajuans_konfirmasi = $query->latest()->get();
        $pdf = Pdf::loadView('pdf.pengajuan', [
            "pengajuans_konfirmasi"  =>   $pengajuans_konfirmasi
        ]);

        $namaFile = Str::slug($nama);
        return $pdf->download('pengajuan-konfirmasi-' . $namaFile . '.pdf');
    }
}
