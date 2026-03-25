<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Pemberitahuan;
use App\Models\Peminjaman;
use App\Models\RiwayatPengajuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    // Menghitung Presentase Kelengkapan Profile Petugas
    private function calculatePresentase()
    {
        $petugas = Auth::user();
        // dd($petugas);

        // Presentase Kelengkapan Profile
        // General (username, email, telepon)
        if ($petugas->username && $petugas->email && $petugas->no_telepon) {
            $general = 30;
        } else {
            $general = 0;
        }
        // Foto
        if ($petugas->profile_photo) {
            $foto = 20;
        } else {
            $foto = 0;
        }
        // Nama petugas
        $nama_lengkap = optional($petugas->petugas)->nama_lengkap ? 10 : 0;
        // Nomor induk
        $nomer_induk = optional($petugas->petugas)->nomer_induk ? 10 : 0;
        // Jenis kelamin
        $jk = optional($petugas->petugas)->jenis_kelamin ? 10 : 0;
        // Tanggal lahir
        $tgl_lahir = optional($petugas->petugas)->tanggal_lahir ? 10 : 0;
        // Alamat
        $alamat = optional($petugas->petugas)->alamat ? 10 : 0;

        // Presentase
        $presentase = $general + $foto + $nama_lengkap + $nomer_induk + $jk + $tgl_lahir + $alamat;
        return $presentase;
        // End Presentase Kelengkapan Profile
    }

    // Jumlah Pengajuan Saat Ini
    private function PengajuanBukuSaatIni()
    {
        $pengajuan = Peminjaman::where('status', 'menunggu')->count();
        return $pengajuan;
    }

    // Pengajuan Terbaru
    private function PengajuanTerbaru()
    {
        $pengajuan_latest = Peminjaman::where('status', 'menunggu')
            ->latest()
            ->limit(3)
            ->get();
        return $pengajuan_latest;
    }

    // Dashboard Petugas
    public function Dashboard_petugas()
    {
        return view('petugas.dashboard', [
            "Pengajuan"    =>    $this->PengajuanBukuSaatIni(),
            "Pengajuan_terbaru" =>  $this->PengajuanTerbaru(),
            "Presentase"   =>    $this->calculatePresentase(),
        ]);
    }

    // Konfirmasi Peminjaman 
    public function RiwayatKonfirmasiPeminjaman(Request $request)
    {
        $cari = $request->input('cari');

        $pengajuans = Peminjaman::where('status', 'menunggu')
            ->when($cari, function ($query, $cari) {
                $query->whereHas('anggota', function ($q) use ($cari) {
                    $q->where('nomer_induk', 'like', '%' . $cari . '%')
                        ->orWhere('nama_lengkap', 'like', '%' . $cari . '%');
                });
            })
            ->paginate(5)->withQueryString();


        return view('petugas.pengajuan', [
            "pengajuans"     =>     $pengajuans,
        ]);
    }

    // Konfirmasi Terima Peminjaman
    public function konfirmasi(Request $request, $id)
    {
        $request->validate([
            "tanggal_jatuh_tempo"  =>     "required|date",
        ]);

        $data = Peminjaman::findOrFail($id);
        $tglPinjam = Carbon::parse($data->tanggal_pinjam);
        $tglTempo = Carbon::parse($request->tanggal_jatuh_tempo);
        $petugas_id  = Auth::user()->Petugas->id;


        // Cek Apakah Tgl Jatuh Tempo lebih kecil dari tanggal pinjam
        // Atau tgl tempo kurang dari tgl pinjam
        if ($tglTempo->lt($tglPinjam)) {
            return back()->with('error', 'Tanggal jatuh tempo tidak boleh kurang dari tanggal pinjam');
        }

        // Cek Apakah Stok Buku Tersedia
        $buku = Buku::where('id', $data->buku_id)->first();
        if ($buku->stok_buku === 0) {
            return back()->with('error', 'Mohon Maaf, Sepertinya stok buku ini kosong!');
        }


        $data->petugas_id = $petugas_id;
        $anggota_id  = $data->anggota_id;
        $data->tanggal_jatuh_tempo = $request->tanggal_jatuh_tempo;
        $data->status = "dipinjam";

        // Kurangi Stok Buku
        $buku->decrement('stok_buku');

        // Simpam Data
        $data->save();

        $pesan = "Peminjaman buku Anda telah disetujui.
                    Rincian:
                    - Judul Buku          : {$data->buku->judul_buku}
                    - Tanggal Pinjam      : " . Carbon::parse($data->tanggal_pinjam)->format('d/m/Y') . "
                    - Tanggal Jatuh Tempo : " . Carbon::parse($request->tanggal_jatuh_tempo)->format('d/m/Y') . "    
                Harap mengembalikan buku sebelum tanggal jatuh tempo untuk menghindari denda.";

        if ($data) {
            // Simpan Data Riwayat Konfirmasi Pengajuan
            RiwayatPengajuan::create([
                "peminjam_id"    =>    $data->id,
                "status"         =>    "dipinjamkan"
            ]);

            // Kirim Pemberitahua ke anggota
            Pemberitahuan::create([
                "anggota_id"   =>    $anggota_id,
                "pesan"        =>    $pesan
            ]);
            return back()->with('success', 'Peminjaman Berhasil Di Konfirmai');
        }
    }

    // TOlak pengajuan
    public function tolak(Request $request, $id)
    {
        $request->validate([
            "alasan"  =>     "required",
        ]);

        $data = Peminjaman::findOrFail($id);
        $petugas_id  = Auth::user()->Petugas->id;
        $anggota_id  = $data->anggota_id;
        $alasan = $request->alasan;

        $data->petugas_id = $petugas_id;
        $data->status = "ditolak";

        $data->save();

        if ($data) {
            // Simpan Data Riwayat Konfirmasi Pengajuan
            RiwayatPengajuan::create([
                "peminjam_id"    =>    $data->id,
                "status"         =>    "ditolak"
            ]);

            //Kirim Pemberitahuan ke anggota
            Pemberitahuan::create([
                "anggota_id"   =>    $anggota_id,
                "pesan"        =>    $alasan
            ]);

            return back()->with('success', 'berhasil menolak pengajuan.');
        }
    }

    // Aktivitas
    public function aktivitas(Request $request)
    {
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

        return view('petugas.aktivitas', [
            "pengajuans_konfirmasi"  =>   $pengajuans_konfirmasi
        ]);
    }
}
