<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAnggotaController;
use App\Http\Controllers\DashboardKepalaPerpusController;
use App\Http\Controllers\KelolaPenggunaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Middleware\isAnggota;
use App\Http\Middleware\isKepalaPerpus;
use Illuminate\Support\Facades\Route;


// Cek Hak Akses
Route::get('/', [RedirectController::class, 'index']);

// Authentication
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login'); // Form Login
    Route::get('/register', [AuthController::class, 'register']); // Form Register

    Route::post('/masuk', [AuthController::class, 'masuk']); // Fungsi Login
    Route::post('/daftar', [AuthController::class, 'daftar']); // Fungsi Register
});
Route::post('/logout', [AuthController::class, 'logout']); // Fungsi Logout
// End Authentication

Route::middleware('auth')->group(function () {
    // Foto Profile Delete
    Route::delete('/foto-profile/{user:id}',[ProfileController::class, 'delete_foto_profile']);
});

// Anggota Routes
Route::middleware(isAnggota::class)->group(function () {
    Route::get('/dashboard-anggota',[DashboardAnggotaController::class, 'Dashboard_Anggota']);

    Route::get('/riwayat-pinjaman', function () {
        return view('Anggota.riwayat-pinjaman');
    });

    Route::get('/daftar-buku', function () {
        return view('Anggota.daftar-buku');
    });
    
    Route::get('/detail-buku', function () {
        return view('Anggota.detail-buku');
    });

    // Profile Anggota
    Route::get('/profile-anggota',[ProfileController::class, 'profile_anggota']);
    Route::put('/profile-anggota',[ProfileController::class, 'profile_update']);
    // End Profile Anggota

    Route::get('/pemberitahuan', function () {
        return view('Anggota.pemberitahuan');
    });

    Route::get('/pemberitahuan/detail', function () {
        return view('Anggota.detail-pemberitahuan');
    });
});



// Kepala Perpustakaan Routes
Route::middleware(isKepalaPerpus::class)->group(function () {
    // Dashboard Kepala Perpus
    Route::get('/dashboard-kepala-perpustakaan',[DashboardKepalaPerpusController::class, 'Dashboard_Kepala_Perpustakaan']);
    // End Dashboard Kepala Perpus

    // Kelola Pengguna
    Route::get('/daftar-pengguna',[KelolaPenggunaController::class, 'daftar_pengguna']); 
    Route::get('/daftar-pengguna/pengguna_perpustakaan={user:id}',[KelolaPenggunaController::class, 'detail_pengguna']);

    Route::get('/daftar-pengguna/tambah-pengguna',[KelolaPenggunaController::class, 'tambah_pengguna_index']);
    Route::post('/daftar-pengguna/tambah-pengguna',[KelolaPenggunaController::class, 'tambah_pengguna']);
    // End Kelola Pengguna
    
    
    // Profile Kepala Perpus
    Route::get('/profile-kepala-perpus',[ProfileController::class, 'profile_kepala_perpus']);
    Route::put('/profile-kepala-perpus',[ProfileController::class, 'profile_update']);
    // End Profile Kepala Perpus
});
