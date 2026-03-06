<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectController extends Controller
{
    public function index()
    {
        // Cek apakah pengguna sudah login
        if (Auth::check()) {
            // Cek Sesuai Role Nya Masing Masing
            if (Auth::user()->role === "anggota") {
                // Anggota
                return redirect('/dashboard-anggota');
            } else if (Auth::user()->role === "petugas") {
                // Ptugas
                return view('Petugas.dashboard');
            } else if (Auth::user()->role === "kepala_perpus") {
                // Kpla perpustakaan
                return redirect('/dashboard-kepala-perpustakaan');
            }
        }else {
            // Jika belum login, redirect ke halaman login
            return redirect()->route('login');
        }
    }
}
