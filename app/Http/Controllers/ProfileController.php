<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\KepalaPerpus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Profile Anggota
    public function profile_anggota()
    {
        return view('Anggota.profile');
    }

    // PROFILE KEPALA PERPUSTKAAN
    public function profile_kepala_perpus()
    {
        return view('Kepala_perpus.profile');
    }

    // Update Profile Anggota
    public function profile_update(Request $request)
    {
        // dd($request->all());
        $user = Auth::user();

        $request->validate([
            "username" => "required|max:14|unique:users,username," . $user->id,
            "no_telepon" => "required|numeric|digits_between:10,15",
            "email" => "required|email|unique:users,email," . $user->id,
            "tanggal_lahir" => "required|date",
            "nama_lengkap" => "required|string|min:4|max:32",
            "nomer_induk" => "required|string|min:6",
            "jenis_kelamin" => "required",
            "alamat" => "required|min:10",
            "profile_photo" => "nullable|image|mimes:jpeg,png,jpg|max:2048",
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
        // UPDATE USER
        $user->update([
            "username" => $request->username,
            "email" => $request->email,
            "no_telepon" => $request->no_telepon,
        ]);

        // CEK KETERSDIAN FOTO
        if ($request->hasFile('profile_photo')) {

            // hapus foto lama kalau ada
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $fhoto = $request->file('profile_photo')->store('profile_photos', 'public');

            $user->update([
                'profile_photo' => $fhoto
            ]);
        }

        // UPDATE ATAU CREATE ANGOTA
        if ($user->role == 'anggota') {
            Anggota::updateOrCreate(
                ['user_id' => $user->id],
                $request->only([
                    'nama_lengkap',
                    'nomer_induk',
                    'jenis_kelamin',
                    'tanggal_lahir',
                    'alamat'
                ])
            );
        }

        // UPDATE ATAU CREATE KEPALA PERPUS
        if ($user->role == 'kepala_perpus') {
            KepalaPerpus::updateOrCreate(
                ['user_id' => $user->id],
                $request->only([
                    'nama_lengkap',
                    'nomer_induk',
                    'jenis_kelamin',
                    'tanggal_lahir',
                    'alamat'
                ])
            );
        }

        return back()->with('success', 'Profile berhasil diperbarui');
    }

    // Hapus Foto Profile
    public function delete_foto_profile(User $user)
    {
        // Cek APakah User Ini Memiliki PP
        if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $user->profile_photo = null;
        $user->save();

        return back();
    }
    // END PROFFILE ANGGOTA

}
