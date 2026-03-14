@extends('layouts.index')

@section('halaman', 'Edit Pengguna')

@section('main')
    <section class="mt-10">
        <form class="all_form" action="/daftar-pengguna/{{ $Data->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Foto Profile --}}
            <div class="mb-5">
                <img class="photoPreview w-32 h-32 object-cover border border-gray-200 p-1"
                    src="{{ $Data->profile_photo ? asset('storage/' . $Data->profile_photo) : asset('icons/default-avatar.png') }}"
                    alt="Foto Profile">
                <input type="file" class="photoInput" name="profile_photo" hidden>
                <button type="button" class="uploadBtn bg-[#35094D] text-white px-5 py-1 rounded-sm cursor-pointer">Upload
                    File</button>
            </div>

            <div class="flex gap-8 items-start">
                {{-- Left Column --}}
                <div class="w-1/2">
                    {{-- Username --}}
                    <div class="my-3">
                        <label class="block text-sm font-medium text-gray-700">Username*</label>
                        @error('username')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                        <input type="text" name="username" value="{{ old('username', $Data->username) }}"
                            class="mt-1 block w-full border border-gray-200 rounded-md bg-white p-2"
                            placeholder="Masukan Username">
                    </div>

                    {{-- Email --}}
                    <div class="my-3">
                        <label class="block text-sm font-medium text-gray-700">Email*</label>
                        @error('email')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                        <input type="email" name="email" value="{{ old('email', $Data->email) }}"
                            class="mt-1 block w-full border border-gray-200 rounded-md bg-white p-2"
                            placeholder="Masukan Email">
                    </div>

                    {{-- No Telepon --}}
                    <div class="my-3">
                        <label class="block text-sm font-medium text-gray-700">No Telepon*</label>
                        @error('no_telepon')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                        <input type="text" name="no_telepon" value="{{ old('no_telepon', $Data->no_telepon) }}"
                            class="mt-1 block w-full border border-gray-200 rounded-md bg-white p-2"
                            placeholder="Masukan No Telepon">
                    </div>

                    {{-- Password --}}
                    <div class="my-3 relative">
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        @error('password')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                        <input type="password" name="password"
                            class="password mt-1 block w-full border border-gray-200 rounded-md bg-white p-2"
                            placeholder="Kosongkan jika tidak diubah">
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-3 top-8 text-gray-500 focus:outline-none">
                            <svg class="eye-open h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                                              c4.477 0 8.268 2.943 9.542 7
                                              -1.274 4.057-5.065 7-9.542 7
                                              -4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg class="eye-close h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19
                                              c-4.478 0-8.268-2.943-9.543-7
                                              a9.956 9.956 0 012.223-3.592M6.18 6.18
                                              A9.956 9.956 0 0112 5
                                              c4.478 0 8.268 2.943 9.543 7
                                              a9.96 9.96 0 01-4.043 4.568M6.18 6.18L4 4
                                              m2.18 2.18l11.64 11.64" />
                            </svg>
                        </button>
                    </div>

                    {{-- Role --}}
                    <div class="my-3">
                        <label class="block text-sm font-medium text-gray-700">Role*</label>
                        @error('role')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                        <select name="role"
                            class="mt-1 block w-full border border-gray-200 rounded-md bg-white p-2 text-gray-400">
                            <option value="" disabled {{ old('role', $Data->role) ? '' : 'selected' }}>Pilih Role
                            </option>
                            <option value="anggota" {{ old('role', $Data->role) == 'anggota' ? 'selected' : '' }}>Anggota
                            </option>
                            <option value="petugas" {{ old('role', $Data->role) == 'petugas' ? 'selected' : '' }}>Petugas
                            </option>
                            <option value="kepala_perpus"
                                {{ old('role', $Data->role) == 'kepala_perpus' ? 'selected' : '' }}>Kepala Perpustakaan
                            </option>
                        </select>
                    </div>
                </div>

                {{-- Right Column --}}
                <div class="w-1/2">
                    {{-- Nama Lengkap --}}
                    <div class="my-3">
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap*</label>
                        <input type="text" name="nama_lengkap"
                            value="{{ old('nama_lengkap', optional($Data->anggota ?? ($Data->petugas ?? $Data->kepalaPerpus))->nama_lengkap) }}"
                            class="mt-1 block w-full border border-gray-200 rounded-md bg-white p-2">
                    </div>

                    {{-- Nomer Induk --}}
                    <div class="my-3">
                        <label class="block text-sm font-medium text-gray-700">Nomer Induk*</label>
                        <input type="text" name="nomer_induk"
                            value="{{ old('nomer_induk', optional($Data->anggota ?? ($Data->petugas ?? $Data->kepalaPerpus))->nomer_induk) }}"
                            class="mt-1 block w-full border border-gray-200 rounded-md bg-white p-2">
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="my-3">
                        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin*</label>
                        <select name="jenis_kelamin"
                            class="mt-1 block w-full border border-gray-200 rounded-md bg-white p-2 text-gray-400">
                            <option value="" disabled {{ old('jenis_kelamin') ? '' : 'selected' }}>Pilih Jenis
                                Kelamin</option>
                            <option value="Laki-laki"
                                {{ old('jenis_kelamin', optional($Data->anggota ?? ($Data->petugas ?? $Data->kepalaPerpus))->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="Perempuan"
                                {{ old('jenis_kelamin', optional($Data->anggota ?? ($Data->petugas ?? $Data->kepalaPerpus))->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="my-3">
                        <label class="block text-sm font-medium text-gray-700">Tanggal Lahir*</label>
                        <input type="date" name="tanggal_lahir"
                            value="{{ old('tanggal_lahir', optional($Data->anggota ?? ($Data->petugas ?? $Data->kepalaPerpus))->tanggal_lahir) }}"
                            class="mt-1 block w-full border border-gray-200 rounded-md bg-white p-2">
                    </div>

                    {{-- Alamat --}}
                    <div class="my-3">
                        <label class="block text-sm font-medium text-gray-700">Alamat*</label>
                        <textarea name="alamat" class="mt-1 block w-full border border-gray-200 rounded-md bg-white p-2">{{ old('alamat', optional($Data->anggota ?? ($Data->petugas ?? $Data->kepalaPerpus))->alamat) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex justify-between mt-5">
                <button type="button" onclick="window.history.back()"
                    class="bg-gray-300 font-medium px-10 py-2 rounded-lg">Kembali</button>
                <button type="submit"
                    class="btn_simpan_perubahan bg-[#35094D] text-white py-2 px-10 rounded flex items-center gap-2">
                    <svg class="spinner_load hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span class="text_simpan">Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </section>

    {{-- Modal Berhasil --}}
    @if (session('success'))
        <section class="success_modal fixed inset-0 bg-black/40 backdrop-blur-sm flex justify-center items-center z-50">
            <div class="bg-white p-6 w-full max-w-[32rem] rounded-xl">

                {{-- Keterangan Modal --}}
                <div class="flex flex-col items-center gap-4">
                    <img class="w-32" src="{{ asset('icons/svg/lamp-success.svg') }}" alt="">
                    <span class="text-[#35094D] font-bold text-center">
                        {{ session('success') }}
                    </span>
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end my-6">
                    <button class="close_modal_success bg-[#35094D] text-white px-10 py-2 rounded-full cursor-pointer">
                        Kembali
                    </button>
                </div>
            </div>
        </section>
        <script>
            document.querySelector('.close_modal_success')?.addEventListener('click', function() {
                document.querySelector('.success_modal').remove();
                location.reload();
            });
        </script>
    @endif

    {{-- Modal Gagal --}}
    @if (session('error'))
        <section class="success_modal fixed inset-0 bg-black/40 backdrop-blur-sm flex justify-center items-center z-50">
            <div class="bg-white p-6 w-full max-w-[30rem] rounded-xl">

                {{-- Keterangan Modal --}}
                <div class="flex flex-col items-center gap-4">
                    <img class="w-52 -ml-20" src="{{ asset('icons/svg/oops.svg') }}" alt="">
                    <span class="text-[#35094D] font-bold text-center">
                        {!! session('error') !!}
                    </span>
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end my-6">
                    <button class="close_modal_success bg-[#35094D] text-white px-10 py-2 rounded-full cursor-pointer">
                        Kembali
                    </button>
                </div>
            </div>
        </section>
        <script>
            document.querySelector('.close_modal_success')?.addEventListener('click', function() {
                document.querySelector('.success_modal').remove();
                location.reload();
            });
        </script>
    @endif

    <script>
        // Toggle password visibility
        function togglePassword() {
            const input = document.querySelector(".password");
            const eyeOpen = document.querySelector(".eye-open");
            const eyeClose = document.querySelector(".eye-close");
            if (input.type === "password") {
                input.type = "text";
                eyeOpen.classList.add("hidden");
                eyeClose.classList.remove("hidden");
            } else {
                input.type = "password";
                eyeOpen.classList.remove("hidden");
                eyeClose.classList.add("hidden");
            }
        }
    </script>
@endsection
