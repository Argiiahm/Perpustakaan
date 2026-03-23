<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Form Halaman Login
    public function login()
    {
        return view('Auth.login');
    }

    // Form Halaman Register
    public function register()
    {
        return view('Auth.register');
    }


    // Fungsi Login
    public function masuk(Request $request)
    {
        $request->validate([
            "email"      =>    "email|required",
            "password"   =>    "required"
        ],[
            "email.email" => "Format email tidak valid.",
        ]);

        $user = User::where('email', $request->email)->first();

        // Cek Apakah Akun Tersebut Ada
        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak terdaftar'
            ])->onlyInput('email');
        }

        // Cek Apakah Password Benar
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Password salah'
            ])->onlyInput('email');
        }

        // Jika Login Berhasil
        Auth::login($user);
        return redirect('/');
    }

    // Fungsi Register
    public function daftar(Request $request)
    {
        $validasiData = $request->validate([
            "username" => "required|max:14|unique:users,username",
            "no_telepon" => "required|numeric|digits_between:10,15",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6"
        ], [
            // pesan validasi
            "username.required" => "Username wajib diisi.",
            "username.max" => "Username maksimal 14 karakter.",
            "username.unique" => "Username sudah digunakan.",

            "no_telepon.required" => "Nomor telepon wajib diisi.",
            "no_telepon.numeric" => "Nomor telepon hanya boleh angka.",
            "no_telepon.digits_between" => "Nomor telepon harus 10-15 digit.",

            "email.required" => "Email wajib diisi.",
            "email.email" => "Format email tidak valid.",
            "email.unique" => "Email sudah terdaftar.",

            "password.required" => "Password wajib diisi.",
            "password.min" => "Password minimal 6 karakter."
        ]);

        $data = $validasiData;
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect('/login');
    }

    // Fungsi Logout
    public function logout(Request $request)
    {
        $request->session()->regenerateToken();
        $request->session()->invalidate();

        return redirect('/');
    }
}
