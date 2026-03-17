<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->input('cari');

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
        $validasiBuku = $request->validate([
            "kode_buku"     =>     "required|unique:buku,kode_buku",
            "judul_buku"    =>     "required|max:30",
            "penulis"       =>     "required|max:30",
            "tahun_terbit"  =>     "required|date",
            "stok_buku"     =>     "required|integer|min:0",
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
            "stok_buku.required"              =>     "Stok buku harus di isi",
            "stok_buku.min"                   =>     "Stok buku tidak valid!",
            "cover_buku.mimes"                =>     "Cover buku harus berupa png,jpg,jpeg dan webp.",
            "cover_buku.max"                  =>     "Cover buku maskimal berukuran 2mb.",
        ]);


        if ($request->hasFile('cover_buku')) {
            $validasiBuku['cover_buku'] = $request->file('cover_buku')->store('cover_bukus', 'public');
        }

        Buku::create($validasiBuku);

        return redirect('/kelola-buku')->with('success', 'Buku Berhasil Ditambahkan.');
    }

    public function delete_buku(Buku $buku) {
        $buku->delete($buku->id);
        return back()->with('success','Buku Berhasil dihapus.');
    }

}
