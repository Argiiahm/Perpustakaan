<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    // Ajukan Pinjaman Buku
    public function ajukanBuku(Request $request)
    {
        $buku_id = $request->buku_id;
        // Jika Anggota id NuLL
        $user = Auth::user();
        if (!$user->anggota) {
            return back()->with('error', 'Opps!, Profile Kamu Sepertinya Masih Kurang lengkap nih!, silahkan isi data yang lengkap yaaa.');
        }
        $anggota_id = Auth::user()->Anggota->id;


        // Waktu Saat Ini
        $SaatIni = Carbon::now();
        // Ambil Data Buku
        $buku = Buku::findOrFail($buku_id);

        // Cek APakah Stok Buku Tersebut Tersedia?
        if ($buku->stok_buku === 0) {
            return back()->with('error', 'Mohon Maaf, Sepertinya stok buku ini kosong!');
        }

        // Cek Apakah Pengguna ini sedang pinjam buku sebanyakk 3 buku?
        $pinjaman = Peminjaman::where('anggota_id', $anggota_id)->where('status', 'dipinjam')->count();
        if ($pinjaman === 3 || $pinjaman >= 3) {
            return back()->with('error', 'Jumlah Pinjaman kamu sudah Mencapai batas pinjaman, silahkan kembalikan buku pinjamanmu terlebih dahulu!');
        }

        // batas pengajuan atau nunggu konfirmasi dulu,
        $batas_pengajuan_pending = Peminjaman::where('anggota_id', $anggota_id)->where('status', 'menunggu')->count();
        if ($batas_pengajuan_pending === 2 || $batas_pengajuan_pending >= 2) {
            return back()->with('error', 'kamu telah mencapai batas pengajuan buku!, silahkan tunggu konfirmasi buku yang kamu pinjam sebelumnya.');
        }

        Peminjaman::create([
            "buku_id"         =>   $buku_id,
            "anggota_id"      =>   $anggota_id,
            "tanggal_pinjam"  =>   $SaatIni
        ]);

        // Kurangi Stok Buku
        // $buku->decrement('stok_buku');

        return back()->with('success', 'selamat, pengajuan buku berhasil silahkan menunggu konfirmasi..');
    }
}
