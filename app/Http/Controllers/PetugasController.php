<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Pemberitahuan;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\RiwayatPengajuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    // Jumlah Pengembalian Buku
    private function PengembalianBuku()
    {
        $pengembalian = Pengembalian::where('status', 'dikembalikan')
            ->count();
        return $pengembalian;
    }

    // Dashboard Petugas
    public function Dashboard_petugas()
    {
        return view('petugas.dashboard', [
            "Pengajuan" => $this->PengajuanBukuSaatIni(),
            "Pengembalian" => $this->PengembalianBuku(),
            "Pengajuan_terbaru" => $this->PengajuanTerbaru(),
            "Presentase" => $this->calculatePresentase(),
        ]);
    }

    // halaman Konfirmasi Peminjaman 
    public function pengajuan(Request $request)
    {
        $cari = $request->input('cari');

        // Ambil data pengajuan dgn status menunggu beserta relasi anggota
        $pengajuans = Peminjaman::where('status', 'menunggu')
            ->when($cari, function ($query, $cari) {
                $query->whereHas('anggota', function ($q) use ($cari) {
                    $q->where('nomer_induk', 'like', '%' . $cari . '%')
                        ->orWhere('nama_lengkap', 'like', '%' . $cari . '%');
                });
            })
            ->paginate(5)->withQueryString();


        return view('petugas.pengajuan', [
            "pengajuans" => $pengajuans,
        ]);
    }

    // Halaman Konfirmasi Pengembalian
    public function pengembalian(Request $request)
    {
        $cari = $request->input('cari');

        // Ambil data pengembalian beserta relasi peminjaman dan anggota
        $pengembalians = Pengembalian::with('peminjaman.anggota')
            ->where('status', 'menunggu')
            ->when($cari, function ($query, $cari) {
                $query->whereHas('peminjaman', function ($q) use ($cari) {
                    $q->whereHas('anggota', function ($q2) use ($cari) {
                        $q2->where('nomer_induk', 'like', '%' . $cari . '%')
                            ->orWhere('nama_lengkap', 'like', '%' . $cari . '%');
                    });
                });
            })->paginate(5)->withQueryString();
        // dd($pengembalians);
        return view('petugas.pengembalian', [
            "pengembalians" => $pengembalians
        ]);
    }

    // Konfirmasi Terima Peminjaman
    public function konfirmasi(Request $request, $id)
    {
        $request->validate([
            "tanggal_jatuh_tempo" => "required|date",
        ]);

        $data = Peminjaman::findOrFail($id);
        $tglPinjam = Carbon::parse($data->tanggal_pinjam);
        $tglTempo = Carbon::parse($request->tanggal_jatuh_tempo)->endOfDay();
        $petugas_id = Auth::user()->Petugas->id ?? null;


        // Cek Apakah Tgl Jatuh Tempo lebih kecil dari tanggal pinjam
        // Atau tgl tempo kurang dari tgl pinjam
        if ($tglTempo->toDateString() < $tglPinjam->toDateString()) {
            return back()->with('error', 'Tanggal jatuh tempo tidak boleh kurang dari tanggal pinjam');
        }

        // Cek Apakah Stok Buku Tersedia
        $buku = Buku::where('id', $data->buku_id)->first();
        if ($buku->stok_buku === 0) {
            return back()->with('error', 'Mohon Maaf, Sepertinya stok buku ini kosong!');
        }

        // Cek Apakah Pengguna ini sedang pinjam buku sebanyakk 3 buku?
        $pinjaman = Peminjaman::where('anggota_id', $data->anggota_id)->where('status', 'dipinjam')->count();
        if ($pinjaman >= 3) {
            return back()->with('error', 'Jumlah Pinjaman Pengguna ini sudah Mencapai batas pinjaman.');
        }

        $data->petugas_id = $petugas_id;
        $anggota_id = $data->anggota_id;
        $data->tanggal_jatuh_tempo = $tglTempo;
        $data->status = "dipinjam";

        // Kurangi Stok Buku
        $buku->decrement('stok_buku');

        // Simpam Data
        $data->save();

        // Pesan Pemberitahuan
        $pesan = "Peminjaman buku Anda telah disetujui.
                    Rincian:
                    - Judul Buku          : {$data->buku->judul_buku}
                    - Tanggal Pinjam      : " . Carbon::parse($data->tanggal_pinjam)->format('d/m/Y') . "
                    - Tanggal Jatuh Tempo : " . Carbon::parse($request->tanggal_jatuh_tempo)->format('d/m/Y') . "    
                Harap mengembalikan buku sebelum tanggal jatuh tempo untuk menghindari denda.";

        if ($data) {
            // Simpan Data Riwayat Konfirmasi Pengajuan
            RiwayatPengajuan::create([
                "peminjam_id" => $data->id,
                "status" => "dipinjamkan"
            ]);

            // Kirim Pemberitahua ke anggota
            Pemberitahuan::create([
                "anggota_id" => $anggota_id,
                "pesan" => $pesan
            ]);
            return back()->with('success', 'Peminjaman Berhasil Di Konfirmai');
        }
    }

    // TOlak pengajuan
    public function tolak(Request $request, $id)
    {
        $request->validate([
            "alasan" => "required",
        ]);

        $data = Peminjaman::findOrFail($id);
        $petugas_id = Auth::user()->Petugas->id;
        $anggota_id = $data->anggota_id;
        $alasan = $request->alasan;

        $data->petugas_id = $petugas_id;
        $data->status = "ditolak";

        $data->save();

        if ($data) {
            // Simpan Data Riwayat Konfirmasi Pengajuan
            RiwayatPengajuan::create([
                "peminjam_id" => $data->id,
                "status" => "ditolak"
            ]);

            //Kirim Pemberitahuan ke anggota
            Pemberitahuan::create([
                "anggota_id" => $anggota_id,
                "pesan" => $alasan
            ]);

            return back()->with('success', 'berhasil menolak pengajuan.');
        }
    }

    // Konfirmasi Pengembalian
    public function pengembalianKonfirmasi(Request $request, $id)
    {
        // dd($request->all()); // debug kalau perlu

        $request->validate([
            'jumlah_denda' => 'nullable|numeric|min:0',
            'total_bayar' => 'nullable|numeric|min:0',
            'jumlah_bayar' => 'nullable|numeric|min:0',
            'jumlah_kembalian' => 'nullable|numeric|min:0',
            'buku_rusak' => 'nullable|numeric|min:0',
            'buku_hilang' => 'nullable|numeric|min:0',
        ]);

        $pengembalian = Pengembalian::with(['peminjaman.buku', 'peminjaman.anggota'])
            ->findOrFail($id);

        $peminjaman = $pengembalian->peminjaman;
        $buku = $peminjaman->buku;
        $anggota = $peminjaman->anggota;

        $jumlah_denda = $request->jumlah_denda ?? 0;
        $jumlah_bayar = $request->jumlah_bayar ?? 0;
        $total_bayar  = $request->total_bayar ?? 0;
        $jumlah_kembalian = $request->jumlah_kembalian ?? 0;

        $is_rusak  = $request->is_rusak == 1;
        $is_hilang = $request->is_hilang == 1;

        // nilai input
        $buku_rusak  = $request->buku_rusak ?? 0;
        $buku_hilang = $request->buku_hilang ?? 0;

        // bayar nanti
        $bayar_nanti = $request->has('bayar_nanti');

        // VALIDASI KONDISI BUKU
        if ($is_rusak && $is_hilang) {
            return back()->with('error', 'Pilih salah satu: buku rusak atau hilang');
        }

        // rusak aktif tapi kosong
        if ($is_rusak && $buku_rusak <= 0) {
            return back()->with('error', 'Isi biaya buku rusak');
        }

        // hilang aktif tapi kosong
        if ($is_hilang && $buku_hilang <= 0) {
            return back()->with('error', 'Isi harga buku hilang');
        }

        // VALIDASI PEMBAYARAN
        if ($jumlah_denda > 0 && !$bayar_nanti) {

            // belum isi bayar
            if ($jumlah_bayar <= 0) {
                return back()->with('error', 'Silahkan isi jumlah bayar');
            }

            // uang kurang
            if ($jumlah_bayar < $jumlah_denda) {
                return back()->with('error', 'Uang bayar kurang dari denda');
            }
        }

        // HITUNG KEMBALIAN
        $jumlah_kembalian = max($jumlah_bayar - $jumlah_denda, 0);

        // default status
        $status_pembayaran = 'lunas';

        // tidak ada transaksi
        if ($jumlah_denda == 0 && $buku_rusak == 0 && $buku_hilang == 0) {

            $status_pembayaran = null;

            $jumlah_bayar = 0;
            $total_bayar = 0;
            $jumlah_kembalian = 0;
        }
        // bayar nanti
        elseif ($bayar_nanti) {

            $status_pembayaran = 'tertunda';

            $jumlah_bayar = 0;
            $total_bayar = 0;
            $jumlah_kembalian = 0;
        }

        // PESAN NOTIF
        $pesan = "Pengembalian buku Anda telah dikonfirmasi.\n\n";
        $pesan .= "Rincian:\n";
        $pesan .= "- Judul Buku : {$buku->judul_buku}\n";
        $pesan .= "- Tanggal Kembalian : " . Carbon::parse($pengembalian->tanggal_kembalian)->format('d/m/Y') . "\n";

        if ($jumlah_denda == 0 && $buku_rusak == 0 && $buku_hilang == 0) {

            $pesan .= "\nTidak ada denda.";
        } elseif ($bayar_nanti) {

            $pesan .= "\nTotal denda: Rp " . number_format($jumlah_denda, 0, ',', '.');
            $pesan .= "\nStatus: Hutang";
        } else {

            $pesan .= "\nTotal denda: Rp " . number_format($jumlah_denda, 0, ',', '.');
            $pesan .= "\nBayar: Rp " . number_format($jumlah_bayar, 0, ',', '.');
            $pesan .= "\nKembalian: Rp " . number_format($jumlah_kembalian, 0, ',', '.');
        }

        if ($buku_rusak > 0) {
            $pesan .= "\nBiaya rusak: Rp " . number_format($buku_rusak, 0, ',', '.');
        }

        if ($buku_hilang > 0) {
            $pesan .= "\nBiaya hilang: Rp " . number_format($buku_hilang, 0, ',', '.');
        }

        $pesan .= "\n\nTerima kasih.";

        // SIMPAN DATA
        DB::transaction(function () use (
            $pengembalian,
            $peminjaman,
            $buku,
            $anggota,
            $jumlah_denda,
            $is_rusak,
            $is_hilang,
            $total_bayar,
            $jumlah_bayar,
            $jumlah_kembalian,
            $status_pembayaran,
            $pesan
        ) {

            $pengembalian->update([
                'jumlah_denda' => $jumlah_denda,
                'total_bayar' => $total_bayar,
                'jumlah_bayar' => $jumlah_bayar,
                'jumlah_kembalian' => $jumlah_kembalian,
                'buku_rusak' => $is_rusak,
                'buku_hilang' => $is_hilang,
                'status' => 'dikembalikan',
                'status_pembayaran' => $status_pembayaran
            ]);

            $peminjaman->update([
                'status' => 'dikembalikan'
            ]);

            $buku->increment('stok_buku');

            Pemberitahuan::create([
                'anggota_id' => $anggota->id,
                'pesan' => $pesan
            ]);
        });

        return back()->with('success', 'Pengembalian berhasil');
    }

    // Halaman Aktivitas Petugas
    public function aktivitas(Request $request)
    {
        $jenis_aktivitas = $request->input('jenis_aktivitas', 'pengajuan');

        if ($jenis_aktivitas === 'pengembalian') {
            $query = Pengembalian::with(['peminjaman.buku', 'peminjaman.anggota'])
                ->where('status', 'dikembalikan')
                ->whereHas('peminjaman', function ($q) {
                    $q->where('petugas_id', Auth::user()->petugas->id);
                });
        } else {
            $query = RiwayatPengajuan::with(['peminjaman.buku', 'peminjaman.anggota'])
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

        // Ambil Data Aktivitas
        $aktivitas_data = $query->latest()->get();

        return view('petugas.aktivitas', [
            "aktivitas_data" => $aktivitas_data,
            "jenis_aktivitas" => $jenis_aktivitas
        ]);
    }
}
