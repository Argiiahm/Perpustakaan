<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->input('cari');

        // Cari Buku Berdasarkan Kode Buku atau Judul Buku
        $bukus = Buku::where(function ($query) use ($cari) {
            $query->where('kode_buku', 'like', "%{$cari}%")
                ->orWhere('judul_buku', 'like', "%{$cari}%");
        })->paginate(10)->withQueryString();


        return view('kelola-buku.index', [
            "Bukus"    =>     $bukus
        ]);
    }

    public function tambah_buku()
    {
        return view('kelola-buku.tambah-buku');
    }

    public function store_buku(Request $request)
    {
        // Validasi Input
        $validasiBuku = $request->validate([
            "kode_buku"     =>     "required|unique:buku,kode_buku",
            "judul_buku"    =>     "required|max:30",
            "penulis"       =>     "required|max:30",
            "tahun_terbit"  =>     "required|date",
            "sinopsis"      =>     "nullable|min:20",
            "stok_buku"     =>     "required|integer|min:0|max:300",
            "cover_buku"    =>     "nullable|mimes:png,jpg,jpeg,webp|max:2048"
        ], [
            "kode_buku.required"              =>     "Kode buku harus di isi.",
            "kode_buku.unique"                =>     "Kode buku sudah di gunakan.",
            "judul_buku.required"             =>     "Judul buku harus di isi.",
            "judul_buku.max"                  =>     "Judul buku maksimal 30 karakter.",
            "penulis.required"                =>     "Penulis harus di isi.",
            "penulis.max"                     =>     "maksimal 30 karakter.",
            "tahun_terbit.required"           =>     "Tahun terbit harus di isi.",
            "tahun_terbit.date"               =>     "Tahun terbit harus berupa tanggal.",
            "sinopsis.min"                    =>     "Sinopsis minimal 20 kata.",
            "stok_buku.required"              =>     "Stok buku harus di isi",
            "stok_buku.min"                   =>     "Stok buku tidak valid!",
            "stok_buku.max"                   =>     "Stok buku maksimal 300 Buku!",
            "cover_buku.mimes"                =>     "Cover buku harus berupa png,jpg,jpeg dan webp.",
            "cover_buku.max"                  =>     "Cover buku maskimal berukuran 2mb.",
        ]);

        // CEK COVER BUKU
        if ($request->hasFile('cover_buku')) {
            $validasiBuku['cover_buku'] = $request->file('cover_buku')->store('cover_bukus', 'public');
        }

        // Buat Data Buku
        Buku::create($validasiBuku);

        return redirect('/kelola-buku')->with('success', 'Buku Berhasil Ditambahkan.');
    }

    public  function edit_buku(Buku $buku)
    {
        return view('kelola-buku.edit-buku', [
            "buku"    =>   $buku
        ]);
    }

    public function update_buku(Request $request, Buku $buku)
    {
        // Validasi Input
        $validasiBuku = $request->validate([
            'kode_buku' => 'required|unique:buku,kode_buku,' . $buku->id,
            "judul_buku"    =>     "required|max:30",
            "penulis"       =>     "required|max:30",
            "tahun_terbit"  =>     "required|date",
            "sinopsis"      =>     "nullable|min:20",
            "stok_buku"     =>     "required|integer|min:0|max:300",
            "cover_buku"    =>     "nullable|mimes:png,jpg,jpeg,webp|max:2048"
        ], [
            "kode_buku.required"              =>     "Kode buku harus di isi.",
            "kode_buku.unique"                =>     "Kode buku sudah di gunakan.",
            "judul_buku.required"             =>     "Judul buku harus di isi.",
            "judul_buku.max"                  =>     "Judul buku maksimal 30 karakter.",
            "penulis.required"                =>     "Penulis harus di isi.",
            "penulis.max"                     =>     "maksimal 30 karakter.",
            "tahun_terbit.required"           =>     "Tahun terbit harus di isi.",
            "tahun_terbit.date"               =>     "Tahun terbit harus berupa tanggal.",
            "sinopsis.min"                    =>     "Sinopsis minimal 20 kata.",
            "stok_buku.required"              =>     "Stok buku harus di isi",
            "stok_buku.min"                   =>     "Stok buku tidak valid!",
            "stok_buku.max"                   =>     "Stok buku maksimal 300 Buku!",
            "cover_buku.mimes"                =>     "Cover buku harus berupa png,jpg,jpeg dan webp.",
            "cover_buku.max"                  =>     "Cover buku maskimal berukuran 2mb.",
        ]);

        // CEK COVER BUKU
        if ($request->hasFile('cover_buku')) {
            if ($buku->cover_buku && Storage::disk('public')->exists($buku->cover_buku)) {
                Storage::disk('public')->delete($buku->cover_buku);
            }
            // Simpan Foto Baru dan Update Path Foto di Database
            $validasiBuku['cover_buku'] = $request->file('cover_buku')->store('cover_bukus', 'public');
        }

        // Update Data Buku
        $buku->update($validasiBuku);
        return back()->with('success', 'Buku Berhasil DiPembaharui.');
    }

    public function delete_buku(Buku $buku)
    {
        // CEK COVER BUKU
        if ($buku->cover_buku && Storage::disk('public')->exists($buku->cover_buku)) {
            Storage::disk('public')->delete($buku->cover_buku);
        }
        // Hapus Data Buku
        $buku->delete($buku->id);
        return back()->with('success', 'Buku Berhasil dihapus.');
    }
}
