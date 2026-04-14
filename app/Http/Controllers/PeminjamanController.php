<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\Clock\now;

class PeminjamanController extends Controller
{
    // Ajukan Pinjaman Buku
    public function ajukanBuku(Request $request)
    {

        // AMBIL DATA SETTING
        $config = Setting::first();
        $max_pinjam = $config->max_pinjam ?? 3;
        $max_pengajuan = $config->max_pengajuan ?? 2;

        // Ambil Data Buku Id
        $buku_id = $request->buku_id;

        // Jika Anggota id NuLL
        $user = Auth::user();
        if (!$user->anggota) {
            return back()->with('error', 'Opps!, Profile Kamu Sepertinya Masih Kurang lengkap nih!, silahkan isi data yang lengkap yaaa.');
        }

        // Ambil Data Anggota Id
        $anggota_id = Auth::user()->Anggota->id;


        // Waktu Saat Ini
        $SaatIni = Carbon::today();

        // Ambil Data Buku
        $buku = Buku::findOrFail($buku_id);

        // Cek APakah Stok Buku Tersebut Tersedia?
        if ($buku->stok_buku === 0) {
            return back()->with('error', 'Mohon Maaf, Sepertinya stok buku ini kosong!');
        }

        // Cek APakah Pengguna Ini Sedang Mempuyai Pembayaran Denda Tertunda?
        // Ambil Data Peminajaman
        $peminjamanIds = Peminjaman::where('anggota_id', $anggota_id)
            ->where('status', 'dikembalikan')
            ->pluck('id');

        $tunggakan = Pengembalian::whereIn('peminjam_id', $peminjamanIds)
            ->where('status', 'dikembalikan')
            ->where('status_pembayaran', 'tertunda')
            ->exists();

        if ($tunggakan) {
            return back()->with('error', 'Kamu masih memiliki tunggakan denda, silahkan selesaikan pembayaran denda kamu, Di Perpustakaan Terdekat.');
        }

        // Cek Apakah Pengguna ini sedang pinjam buku sebanyakk $max_pinjam buku?
        $pinjaman = Peminjaman::where('anggota_id', $anggota_id)->where('status', 'dipinjam')->count();
        if ($pinjaman === $max_pinjam || $pinjaman >= $max_pinjam) {
            return back()->with('error', 'Jumlah Pinjaman kamu sudah Mencapai batas pinjaman, silahkan kembalikan buku pinjamanmu terlebih dahulu!');
        }

        // batas pengajuan atau nunggu konfirmasi dulu,
        $batas_pengajuan_pending = Peminjaman::where('anggota_id', $anggota_id)->where('status', 'menunggu')->count();
        if ($batas_pengajuan_pending === $max_pengajuan || $batas_pengajuan_pending >= $max_pengajuan) {
            return back()->with('error', 'kamu telah mencapai batas pengajuan buku!, silahkan tunggu konfirmasi buku yang kamu pinjam sebelumnya.');
        }

        // Buat Data Peminjaman
        Peminjaman::create([
            "buku_id"         =>   $buku_id,
            "anggota_id"      =>   $anggota_id,
            "tanggal_pinjam"  =>   $SaatIni,
            "tanggal_jatuh_tempo" => Carbon::parse($request->tanggal_jatuh_tempo)->endOfDay(),
            "status"          =>   "menunggu"
        ]);

        return back()->with('success', 'selamat, pengajuan buku berhasil silahkan menunggu konfirmasi..');
    }

    public function kembalikanBuku($id)
    {
        // Ambil Data Peminjaman
        $peminjaman = Peminjaman::findOrFail($id);

        // Waktu Hari Ini
        $hariIni = Carbon::today();
        // Waktu Jatuh Tempo
        $jatuhTempo = Carbon::parse($peminjaman->tanggal_jatuh_tempo)->startOfDay();

        // hitung selisih hari
        $terlambat = 0;

        // Jika Hari Ini Lebih Besar Dari Jatuh Tempo, maka hitung keterlambatan
        if ($hariIni->gt($jatuhTempo)) {
            $terlambat = $jatuhTempo->diffInDays($hariIni);
        }

        // Buat Data Pengembalian
        Pengembalian::create([
            "peminjam_id"   =>   $peminjaman->id,
            "total_hari_terlambat" => $terlambat,
            "tanggal_kembalikan"   => Carbon::today(),
            "status"        =>   "menunggu"
        ]);

        return back()->with('success', 'Ajukan Pengembalian Berhasil, silahkan menunggu konfirmasi..');
    }
}
