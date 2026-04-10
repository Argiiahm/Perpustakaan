<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function settingIndex()
    {
        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([
                'max_pinjam' => 3,
                'max_pengajuan' => 2,
                'denda_per_hari' => 1000,
            ]);
        }
        return view('Kepala_perpus.setting', [
            "setting" => $setting
        ]);
    }

    public function settingUpdate(Request $request)
    {
        $request->validate([
            'max_pinjam'     => 'required|integer|min:1',
            'max_pengajuan'  => 'required|integer|min:1',
            'denda_per_hari' => 'required|integer|min:1000',
        ],[
            "max_pinjam.required" => "Batas maksimal peminjaman harus diisi.",
            "max_pinjam.integer" => "Batas maksimal peminjaman harus berupa angka.",
            "max_pinjam.min" => "Batas maksimal peminjaman harus minimal 1 buku.",
            "max_pengajuan.required" => "Batas maksimal pengajuan harus diisi.",
            "max_pengajuan.integer" => "Batas maksimal pengajuan harus berupa angka.",
            "max_pengajuan.min" => "Batas maksimal pengajuan harus minimal 1 pengajuan.",
            "denda_per_hari.required" => "Denda per hari harus diisi.",
            "denda_per_hari.integer" => "Denda per hari harus berupa angka.",
            "denda_per_hari.min" => "Denda per hari harus minimal 1000 rupiah.",
        ]);

        // UpdateOrCreate
        Setting::updateOrCreate(
            ['id' => 1], // selalu baris pertama
            [
                'max_pinjam'     => $request->max_pinjam,
                'max_pengajuan'  => $request->max_pengajuan,
                'denda_per_hari' => $request->denda_per_hari,
            ]
        );

        return redirect()->back()->with('success', 'Konfigurasi berhasil diperbarui!');
    }
}
