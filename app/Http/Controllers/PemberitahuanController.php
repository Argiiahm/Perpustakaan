<?php

namespace App\Http\Controllers;

use App\Models\Pemberitahuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemberitahuanController extends Controller
{
    public function index() {
        $anggota_id     =  Auth::user()->Anggota->id ?? null;
        $pemberitahuans = Pemberitahuan::where('anggota_id',$anggota_id)->get();
        return view('Anggota.pemberitahuan',[
            "pemberitahuans"   =>   $pemberitahuans
        ]);
    }

    public function detailPemberitahuan(Pemberitahuan $pemberitahuan) {
        return view('Anggota.detail-pemberitahuan',[
            "pemberitahuan"   => $pemberitahuan
        ]);
    }

    public function readPemberitahuan($id) {
        $pemberitahuan = Pemberitahuan::findOrFail($id);
        $pemberitahuan->sudah_dilihat = 1;

        $pemberitahuan->save();

        return back();
    }
}
