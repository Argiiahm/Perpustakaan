<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    //Halaman Laporan Petugas
    public function indexPetugas(Request $request)
    {
        $cari = $request->input('cari');

        // Ambil Data Laporan Berdasarkan Petugas Id dan Filter Cari
        $petugas_id = Auth::user()->Petugas->id;
        $laporans = Laporan::where('petugas_id', $petugas_id)
            ->where(function ($query) use ($cari) {
                $query->where('created_at', 'like', "%{$cari}%");
            })
            ->paginate(10)
            ->withQueryString();
        return view('petugas.laporan', [
            "laporans" => $laporans
        ]);
    }

    // Simpan Laporan Petugas
    public function storeLaporan(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'tipe_laporan' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Ambil Data Petugas Id
        $petugas_id = Auth::user()->Petugas->id;

        // Inisialisasi Variabel filePath dengan NULL
        $filePath = null;

        // Jika File Laporan Diupload, Simpan File dan Ambil Pathnya
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('laporan', 'public');
        }

        // Buat Data Laporan Baru dengan Tipe Laporan, Petugas Id, dan Path File Laporan
        Laporan::create([
            "tipe_laporan" => $request->tipe_laporan,
            "petugas_id" => $petugas_id,
            "file" => $filePath,
        ]);

        return back()->with('success', 'Laporan berhasil diupload!');
    }

    // Daftar Laporan Kepala Perpus
    public function daftarLaporanKepalaPerpus(Request $request)
    {
        // Ambil Jenis Laporan dari Reques
        $jenis_laporan = $request->input('jenis_laporan', 'Semua');

        // Ambil Data Laporan Berdasarkan Jenis Laporan
        if ($jenis_laporan == 'Semua') {
            // Jika Jenis Laporan Semua, Ambil Semua Data Laporan
            $laporans = Laporan::paginate(10)->withQueryString();
        } elseif ($jenis_laporan == 'Konfirmasi Pengajuan') {
            // Jika Jenis Laporan Konfirmasi Pengajuan, Ambil Data Laporan dengan Tipe Laporan Konfirmasi Pengajuan
            $laporans = Laporan::where('tipe_laporan', 'Konfirmasi Pengajuan')
                ->paginate(10)
                ->withQueryString();
        } elseif ($jenis_laporan == 'Konfirmasi Pengembalian') {
            // Jika Jenis Laporan Konfirmasi Pengembalian, Ambil Data Laporan dengan Tipe Laporan Konfirmasi Pengembalian
            $laporans = Laporan::where('tipe_laporan', 'Konfirmasi Pengembalian')
                ->paginate(10)
                ->withQueryString();
        }
        return view('Kepala_perpus.daftar-laporan', [
            "laporans" => $laporans
        ]);
    }

    //(Kepala Perpus) - Approve Laporan
    public function approveLaporan($id)
    {
        // Ambil Data Laporan Berdasarkan Id
        $laporan = Laporan::findOrFail($id);

        // Tandai Laporan Sebagai Approved
        $laporan->status = "approved";
        // Simpan Perubahan
        $laporan->save();

        return back()->with('success', 'Laporan Berhasil Di Approved');
    }

    //(Kepala Perpus) - Reject Laporan
    public function rejectLaporan($id)
    {
        // Ambil Data Laporan Berdasarkan Id
        $laporan = Laporan::findOrFail($id);

        // Hapus FILE Laporan jika ada
        if ($laporan->file) {
            Storage::disk('public')->delete($laporan->file);
        }

        // Tandai Laporan Sebagai Rejected
        $laporan->status = "rejected";
        // Update File Laporan Menjadi "Laporan Ditolak"
        $laporan->file = "Laporan Ditolak";
        // Simpan Perubahan
        $laporan->save();

        return back()->with('success', 'Laporan Berhasil Di Rejected');
    }
}
