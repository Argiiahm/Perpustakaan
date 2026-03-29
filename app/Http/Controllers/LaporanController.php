<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    //Halaman Laporan Petugas
    public function indexPetugas(Request $request)
    {
        $cari = $request->input('cari');

        $petugas_id = Auth::user()->Petugas->id;
        $laporans = Laporan::where('petugas_id', $petugas_id)
            ->where(function ($query) use ($cari) {
                $query->where('created_at', 'like', "%{$cari}%");
            })
            ->paginate(10)
            ->withQueryString();
        return view('petugas.laporan',[
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

        $petugas_id = Auth::user()->Petugas->id;

        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('laporan', 'public');
        }

        Laporan::create([
            "tipe_laporan" => $request->tipe_laporan,
            "petugas_id" => $petugas_id,
            "file" => $filePath,
        ]);

        return back()->with('success', 'Laporan berhasil diupload!');
    }
}
