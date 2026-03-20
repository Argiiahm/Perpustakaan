<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardKepalaPerpusController;
use App\Http\Controllers\KelolaPenggunaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Middleware\is_pengguna_and_kepala_perpus;
use App\Http\Middleware\isAnggota;
use App\Http\Middleware\isKepalaPerpus;
use App\Http\Middleware\isPetugas;
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
    Route::delete('/foto-profile/{user:id}', [ProfileController::class, 'delete_foto_profile']);
});

// Anggota Routes
Route::middleware(isAnggota::class)->group(function () {
    // Dashboard Anggota
    Route::get('/dashboard-anggota', [AnggotaController::class, 'Dashboard_Anggota']);
    // Riwayat Pinjaman
    Route::get('/riwayat-pinjaman', [AnggotaController::class, 'riwayat_pinjaman']);
    // Daftar Buku
    Route::get('/daftar-buku', [AnggotaController::class, 'daftar_buku']);
    // Ajukan Buku
    Route::post('/ajukan-buku', [PeminjamanController::class, 'ajukanBuku']);
    // Detail Buku
    Route::get('/daftar-buku/detail-buku={buku:id}', [AnggotaController::class, 'detail_buku']);

    // Profile Anggota
    Route::get('/profile-anggota', [ProfileController::class, 'profile_anggota']);
    Route::put('/profile-anggota', [ProfileController::class, 'profile_update']);
    // End Profile Anggota

    Route::get('/pemberitahuan', function () {
        return view('Anggota.pemberitahuan');
    });

    Route::get('/pemberitahuan/detail', function () {
        return view('Anggota.detail-pemberitahuan');
    });
});

// Petugas Routes
Route::middleware(isPetugas::class)->group(function () {
    // Dashboard Petugas
    Route::get('/dashboard-petugas', [PetugasController::class, 'Dashboard_petugas']);
    // Profile Petugas
    Route::get('/profile-petugas', [ProfileController::class, 'profile_petugas']);
    Route::put('/profile-petugas', [ProfileController::class, 'profile_update']);
});

// Kepala Perpustakaan Routes
Route::middleware(isKepalaPerpus::class)->group(function () {
    // Dashboard Kepala Perpus
    Route::get('/dashboard-kepala-perpustakaan', [DashboardKepalaPerpusController::class, 'Dashboard_Kepala_Perpustakaan']);
    // End Dashboard Kepala Perpus

    // Kelola Pengguna
    Route::get('/daftar-pengguna', [KelolaPenggunaController::class, 'daftar_pengguna']);
    Route::delete('/daftar-pengguna/{user:id}', [KelolaPenggunaController::class, 'delete_pengguna']);
    Route::put('/daftar-pengguna/{user:id}', [KelolaPenggunaController::class, 'update_pengguna']);
    Route::get('/daftar-pengguna/detail/pengguna_perpustakaan={user:id}', [KelolaPenggunaController::class, 'detail_pengguna']);
    Route::get('/daftar-pengguna/edit/pengguna_perpustakaan={user:id}', [KelolaPenggunaController::class, 'edit_pengguna']);

    Route::get('/daftar-pengguna/tambah-pengguna', [KelolaPenggunaController::class, 'tambah_pengguna_index']);
    Route::post('/daftar-pengguna/tambah-pengguna', [KelolaPenggunaController::class, 'tambah_pengguna']);
    // End Kelola Pengguna


    // Profile Kepala Perpus
    Route::get('/profile-kepala-perpus', [ProfileController::class, 'profile_kepala_perpus']);
    Route::put('/profile-kepala-perpus', [ProfileController::class, 'profile_update']);
    // End Profile Kepala Perpus
});

// Kelola Buku Petugas Perpus, Dan Kepala Perpus
Route::middleware(is_pengguna_and_kepala_perpus::class)->group(function () {
    // Kelola Buku
    Route::get('/kelola-buku', [BukuController::class, 'index']);
    Route::get('/kelola-buku/tambah-buku', [BukuController::class, 'tambah_buku']);
    Route::post('/kelola-buku', [BukuController::class, 'store_buku']);
    Route::get('/kelola-buku/{buku:id}', [BukuController::class, 'edit_buku']);
    Route::put('/kelola-buku/{buku:id}', [BukuController::class, 'update_buku']);
    Route::delete('/kelola-buku/{buku:id}', [BukuController::class, 'delete_buku']);
});
