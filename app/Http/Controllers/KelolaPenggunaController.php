<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\KepalaPerpus;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KelolaPenggunaController extends Controller
{
    public function daftar_pengguna(Request $request)
    {
        // Searcing
        $cari = $request->input('cari');

        $users = User::where(function ($query) use ($cari) {

            $query->where('username', 'like', "%{$cari}%")
                ->orWhere('email', 'like', "%{$cari}%")

                // Anggota
                ->orWhereHas('anggota', function ($q) use ($cari) {
                    $q->where('nama_lengkap', 'like', "%{$cari}%")
                        ->orWhere('nomer_induk', 'like', "%{$cari}%");
                })

                ->orWhereHas('petugas', function ($q) use ($cari) {
                    $q->where('nama_lengkap', 'like', "%{$cari}%")
                        ->orWhere('nomer_induk', 'like', "%{$cari}%");
                })

                // Kpala Perpus
                ->orWhereHas('KepalaPerpus', function ($q) use ($cari) {
                    $q->where('nama_lengkap', 'like', "%{$cari}%")
                        ->orWhere('nomer_induk', 'like', "%{$cari}%");
                });
        })->paginate(5)
            // Paginasi
            ->withQueryString();

        return view('Kepala_perpus.daftar-pengguna', [
            "Users"    =>    $users
        ]);
    }

    public function detail_pengguna(User $user)
    {
        return view('Kepala_perpus.detail-pengguna', [
            "User"   =>   $user
        ]);
    }

    public function tambah_pengguna_index()
    {
        return view('Kepala_perpus.tambah-pengguna');
    }

    public function tambah_pengguna(Request $request)
    {
        $request->validate([
            "username" => "required|max:14|unique:users,username",
            "no_telepon" => "required|numeric|digits_between:10,15",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6",
            "role"     => "required",
            "profile_photo" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
            "nama_lengkap" => "required|string|min:4|max:32",
            "nomer_induk" => "required|string|min:6",
            "jenis_kelamin" => "required",
            "tanggal_lahir" => "required|date",
            "alamat" => "required|min:10",
        ], [
            "username.required" => "Username wajib diisi",
            "username.max" => "Username maksimal 14 karakter",
            "username.unique" => "Username sudah digunakan",
            "no_telepon.required" => "No Telepon wajib diisi",
            "no_telepon.numeric" => "No Telepon harus berupa angka",
            "no_telepon.digits_between" => "No Telepon harus antara 10 sampai 15 digit",
            "email.required" => "Email wajib diisi",
            "email.email" => "Email tidak valid",
            "email.unique" => "Email sudah digunakan",
            "password.required" => "Password wajib diisi.",
            "password.min" => "Password minimal 6 karakter.",
            "role"   =>   "Role Harus Di Isi",
            "tanggal_lahir.date" => "Tanggal Lahir harus berupa tanggal",
            "tanggal_lahir.required" => "Tanggal Lahir harus di isi",
            "nama_lengkap.string" => "Nama Lengkap harus berupa string",
            "nama_lengkap.required" => "Nama Lengkap Harus di isi",
            "nama_lengkap.min" => "Nama Lengkap minimal 4 karakter",
            "nama_lengkap.max" => "Nama Lengkap maksimal 32 karakter",
            "nomer_induk.string" => "Nomer Induk harus berupa string",
            "nomer_induk.min" => "Nomer Induk minimal 6 karakter",
            "nomer_induk.required" => "Nomer Induk harus di isi",
            "alamat.min" => "Alamat Lengkap  minimal 10 karakter",
            "alamat.required" => "Alamat Lengkap harus di isi",
            "profile_photo.image" => "Profile Photo harus berupa gambar",
            "profile_photo.mimes" => "Profile Photo harus berupa file dengan ekstensi jpeg, png, jpg",
            "profile_photo.max" => "Profile Photo maksimal berukuran 2MB",
        ]);

        $profilePhoto = null;

        if ($request->hasFile('profile_photo')) {
            $profilePhoto = $request->file('profile_photo')->store('profile_photos', 'public');
        }


        // Buat Data User Baru
        $user = User::create([
            "username"        =>    $request->username,
            "no_telepon"      =>    $request->no_telepon,
            "email"           =>    $request->email,
            "password"        => Hash::make($request->password),
            "role"            =>    $request->role,
            "profile_photo"   =>    $profilePhoto
        ]);

        // Cek APabila Role Anggota
        if ($request->role === "anggota") {
            Anggota::create([
                "user_id"         =>   $user->id,
                "nama_lengkap"    =>    $request->nama_lengkap,
                "nomer_induk"     =>    $request->nomer_induk,
                "jenis_kelamin"   =>    $request->jenis_kelamin,
                "tanggal_lahir"   =>    $request->tanggal_lahir,
                "alamat"          =>    $request->alamat,
            ]);
            // Petugas
        } elseif ($request->role === "petugas") {
            Petugas::create([
                "user_id"         =>    $user->id,
                "nama_lengkap"    =>    $request->nama_lengkap,
                "nomer_induk"     =>    $request->nomer_induk,
                "jenis_kelamin"   =>    $request->jenis_kelamin,
                "tanggal_lahir"   =>    $request->tanggal_lahir,
                "alamat"          =>    $request->alamat,
            ]);
            // Kepala Perpustkaan
        } elseif ($request->role === "kepala_perpus") {
            KepalaPerpus::create([
                "user_id"         =>    $user->id,
                "nama_lengkap"    =>    $request->nama_lengkap,
                "nomer_induk"     =>    $request->nomer_induk,
                "jenis_kelamin"   =>    $request->jenis_kelamin,
                "tanggal_lahir"   =>    $request->tanggal_lahir,
                "alamat"          =>    $request->alamat,
            ]);
        }

        return redirect('/daftar-pengguna')->with('success', 'Pengguna berhasil ditambahkan');
    }
}
