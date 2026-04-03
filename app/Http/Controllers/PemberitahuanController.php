<?php

namespace App\Http\Controllers;

use App\Models\Pemberitahuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemberitahuanController extends Controller
{
    public function index()
    {
        // Ambil Data Pemberitahuan Berdasarkan Anggota Id
        $anggota_id     =  Auth::user()->Anggota->id ?? null;
        $pemberitahuans = Pemberitahuan::where('anggota_id', $anggota_id)->get();
        return view('Anggota.pemberitahuan', [
            "pemberitahuans"   =>   $pemberitahuans
        ]);
    }

    public function detailPemberitahuan(Pemberitahuan $pemberitahuan)
    {
        return view('Anggota.detail-pemberitahuan', [
            "pemberitahuan"   => $pemberitahuan
        ]);
    }

    public function readPemberitahuan($id)
    {
        // Ambil Data Pemberitahuan Berdasarkan Id
        $pemberitahuan = Pemberitahuan::findOrFail($id);
        // Tandai Pemberitahuan Sudah Dilihat
        $pemberitahuan->sudah_dilihat = 1;
        // Simpan Perubahan
        $pemberitahuan->save();

        return back();
    }
}
