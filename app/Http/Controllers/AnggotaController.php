<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaController extends Controller
{
    // Menghitung Presentase Kelengkapan Profile Anggota
    private function calculatePresentase()
    {
        // Ambil Data Anggota
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
        // Ambil Data Anggota Id
        $anggota_id = Auth::user()->Anggota->id ?? null;
        // Ambil Data Total Pinjaman dan Total Pengembalian
        $totalPinjaman = Peminjaman::where('anggota_id', $anggota_id)->where('status', 'dipinjam')->count();
        // Ambil Data Total Pengembalian
        $totalPengembalian = Pengembalian::with('peminjaman')
            ->where('status', 'dikembalikan')
            ->whereHas('peminjaman', function ($query) use ($anggota_id) {
                $query->where('anggota_id', $anggota_id);
            })->count();

        // Ambil Data Pinjaman Aktif
        $Pinjaman_aktif = Peminjaman::with('buku')->where('anggota_id', $anggota_id)
            ->where('status', 'dipinjam')
            ->get();

        // Hitung Sisa Hari
        foreach ($Pinjaman_aktif as $pinjaman) {
            if ($pinjaman->tanggal_jatuh_tempo) {
                $sisa = floor(Carbon::now()->diffInDays($pinjaman->tanggal_jatuh_tempo, false));
                $pinjaman->sisa_hari = $sisa;
            } else {
                $pinjaman->sisa_hari = null;
            }
        }

        return view('Anggota.dashboard', [
            "Presentase"   =>    $this->calculatePresentase(),
            "Pinjaman_aktif"  =>  $Pinjaman_aktif,
            "totalPinjaman"   =>   $totalPinjaman,
            "totalPengembalian" =>  $totalPengembalian
        ]);
    }

    // Halaman Riwayat Pinjaman
    public function riwayat_pinjaman()
    {
        // Ambil Data Anggota Id
        $anggota_id = Auth::user()->Anggota->id ?? null;
        // Ambil Data Pengajuan dan Pengembalian Berdasarkan Anggota Id
        $pengajuans = Peminjaman::whereIn('status', ['dipinjam', 'menunggu'])
            ->where('anggota_id', $anggota_id)
            ->paginate(3);

        // Ambil Data Pengembalian Berdasarkan Anggota Id
        $pengembalians = Pengembalian::with([
            'peminjaman.anggota',
            'peminjaman.buku'
        ])
            ->where('status', 'dikembalikan')
            ->whereHas('peminjaman', function ($query) use ($anggota_id) {
                $query->where('anggota_id', $anggota_id);
            })->latest()
            ->paginate(5);
        // dd($pengembalians);

        return view('Anggota.riwayat-pinjaman', [
            "pengajuans"   =>    $pengajuans,
            "pengembalians" =>   $pengembalians
        ]);
    }

    // Halaman Denda Saya
    public function dendaAnggota()
    {
        $anggota_id  = Auth::user()->anggota->id;

        // ambil peminjaman yg sudah dikembalikan
        $peminjamans = Peminjaman::where('anggota_id', $anggota_id)
            ->where('status', 'dikembalikan')
            ->get();

        // ambil pengembalian berdasarkan peminjaman
        $pengembalians = Pengembalian::whereIn('peminjam_id', $peminjamans->pluck('id'))
            ->where('status_pembayaran', 'tertunda')
            ->paginate(3)->withQueryString();

        // Riwayat Denda Saya
        $RiwayatsDenda = Pengembalian::whereIn('peminjam_id', $peminjamans->pluck('id'))
            ->where('status_pembayaran', 'lunas')
            ->paginate(5)->withQueryString();


        return view('Anggota.denda-saya', [
            "pengembalians"  =>  $pengembalians,
            "RiwayatsDenda"  =>  $RiwayatsDenda
        ]);
    }

    // Halaman Daftar Buku
    public function daftar_buku(Request $request)
    {

        $cari = $request->input('cari');
        // Cari Buku Berdasarkan Kode Buku, Judul Buku, atau Penulis
        $bukus = Buku::where(function ($query) use ($cari) {
            $query->where('judul_buku', 'like', "%{$cari}%")
                ->orWhere('penulis', 'like', "%{$cari}%")
                ->orWhere('kode_buku', 'like', "%{$cari}%");
        })->paginate(10)
            // Paginasi
            ->withQueryString();

        return view('Anggota.daftar-buku', [
            "Bukus"   =>    $bukus
        ]);
    }

    // Detail Buku
    public function detail_buku(Buku $buku)
    {
        // Ambil Data Anggota Id
        $anggota_id = Auth::user()->Anggota->id ?? null;
        // Button Sedang pending
        $pengajuan_pending = Peminjaman::where('anggota_id', $anggota_id)->where('buku_id', $buku->id)->where('status', 'menunggu')->exists();
        // button sedang dipinjam
        $pengajuan_dipinjam = Peminjaman::where('anggota_id', $anggota_id)->where('buku_id', $buku->id)->where('status', 'dipinjam')->first();
        return view('Anggota.detail-buku', [
            "buku"   =>    $buku,
            "pending"  =>  $pengajuan_pending,
            "dipinjam" =>  $pengajuan_dipinjam
        ]);
    }
}
