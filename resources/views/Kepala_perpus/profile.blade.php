@extends('layouts.index')

@section('main')
    {{-- Header --}}
    <section>
        <h1 class="text-[30px] text-[#35094D]">Hallo, <span
                class="font-semibold">{{ Auth::user()->KepalaPerpus->nama_lengkap ?? Auth::user()->username }}</span></h1>
        <span class="text-[#35094d90]">Selamat Datang Kembali Di Halaman <span
                class="font-medium text-[#35094D]">Profile</span> Anda!</span>
    </section>

    {{-- FORM PROFILE --}}
    <section class="mt-20">
        <form class="profile-form" action="/profile-kepala-perpus" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- POTO Profile --}}
            <div class="flex items-center gap-4">
                <img class="photoPreview w-20 h-20 object-cover border border-gray-200 p-1" id=""
                    src="{{ Auth::user()->profile_photo
                        ? asset('storage/' . Auth::user()->profile_photo)
                        : asset('icons/default-avatar.png') }}"
                    alt="">
                <input type="file" class="photoInput" name="profile_photo" hidden>

                <div class="flex flex-col">
                    <span class="text-[20px] text-[#35094D] font-medium">{{ Auth::user()->username }}</span>
                    <span class="text-[#35094d90] text-[11px]">{{ Auth::user()->role }}#{{ Auth::user()->id }}</span>
                    @error('profile_photo')
                        <div style="color:red; font-size:14px;">{{ $message }}</div>
                    @enderror
                </div>
                <div class="flex items-center gap-4 ml-10">
                    <button class="uploadBtn bg-[#35094D] text-white px-4 py-2 rounded-sm cursor-pointer" type="button"
                        id="">Upload Foto Baru</button>
                    <button form="deleteProfilePicture"
                        class="text-[#35094D] border border-gray-200 cursor-pointer px-4 py-2 rounded-sm"
                        type="submit">Hapus Foto</button>
                </div>
            </div>
            {{-- END PTO PROFILE --}}

            {{-- Input BioData --}}
            <div class="flex gap-8 items-start">
                {{-- Default Input Data --}}
                <div class="w-1/2">
                    {{-- Username --}}
                    <div class="my-5">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Username*</label>
                        @error('username')
                            <div style="color:red; font-size:14px;">{{ $message }}</div>
                        @enderror
                        <input type="text" name="username"
                            class="mt-1 block w-full border border-gray-200 rounded-md bg-white p-2 text-gray-400"
                            value="{{ Auth::user()->username }}">
                    </div>

                    {{-- Email --}}
                    <div class="my-5">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email*</label>
                        @error('email')
                            <div style="color:red; font-size:14px;">{{ $message }}</div>
                        @enderror
                        <input type="email" name="email"
                            class="mt-1 block w-full border border-gray-200 rounded-md bg-white p-2 text-gray-400"
                            value="{{ Auth::user()->email }}">
                    </div>

                    {{-- No telp --}}
                    <div class="my-5">
                        <label for="no_telp" class="block text-sm font-medium text-gray-700">No Telepon*</label>
                        @error('no_telepon')
                            <div style="color:red; font-size:14px;">{{ $message }}</div>
                        @enderror
                        <input type="text" name="no_telepon"
                            class="mt-1 block w-full border border-gray-200 rounded-md bg-white p-2 text-gray-400"
                            value="{{ Auth::user()->no_telepon }}">
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="my-5">
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir*</label>
                        @error('tanggal_lahir')
                            <div style="color:red; font-size:14px;">{{ $message }}</div>
                        @enderror
                        <input type="date" name="tanggal_lahir"
                            class="mt-1 block w-full border border-gray-200 rounded-md bg-white p-2 text-gray-400"
                            value="{{ Auth::user()->KepalaPerpus->tanggal_lahir ?? '' }}">
                    </div>
                </div>

                {{-- data laina --}}
                <div class="w-1/2">
                    {{-- Nama Lengkap --}}
                    <div class="my-5">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap*</label>
                        @error('nama_lengkap')
                            <div style="color:red; font-size:14px;">{{ $message }}</div>
                        @enderror
                        <input type="text" name="nama_lengkap"
                            class="mt-1 block w-full border border-gray-200 rounded-md bg-white p-2 text-gray-400"
                            placeholder="Masukan Nama Lengkap Anda"
                            value="{{ old('nama_lengkap', Auth::user()->KepalaPerpus->nama_lengkap ?? '') }}">
                    </div>

                    {{-- Nomer Induk --}}
                    <div class="my-5">
                        <label for="nomer_induk" class="block text-sm font-medium text-gray-700">Nomer Induk*</label>
                        @error('nomer_induk')
                            <div style="color:red; font-size:14px;">{{ $message }}</div>
                        @enderror
                        <input type="text" name="nomer_induk"
                            class="mt-1 block w-full border border-gray-200 rounded-md bg-white p-2 text-gray-400"
                            placeholder="Masukan NIS/NIK Anda"
                            value="{{ old('nomer_induk', Auth::user()->KepalaPerpus->nomer_induk ?? '') }}">
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="my-5">
                        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin*</label>

                        <select name="jenis_kelamin"
                            class="mt-1 block w-full border border-gray-200 text-gray-400 rounded-md bg-white p-2">

                            <option value="" disabled
                                {{ old('jenis_kelamin', Auth::user()->KepalaPerpus->jenis_kelamin ?? '') == '' ? 'selected' : '' }}>
                                Pilih Jenis Kelamin
                            </option>

                            <option value="Laki-laki"
                                {{ old('jenis_kelamin', Auth::user()->KepalaPerpus->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki
                            </option>

                            <option value="Perempuan"
                                {{ old('jenis_kelamin', Auth::user()->KepalaPerpus->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>

                        </select>
                    </div>

                    {{-- Alamat --}}
                    <div class="my-5">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat*</label>
                        @error('alamat')
                            <div style="color:red; font-size:14px;">{{ $message }}</div>
                        @enderror
                        <textarea type="text" name="alamat"
                            class="mt-1 block w-full border border-gray-200 rounded-md bg-white p-2 text-gray-400"
                            placeholder="Masukan Alamat Anda">{{ Auth::user()->KepalaPerpus->alamat ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Action --}}
            <div class="flex justify-end">
                <button id="" type="submit"
                    class="btn_simpan_perubahan bg-[#35094D] text-white py-2 px-10 cursor-pointer rounded mt-5 flex items-center gap-2">
                    <svg id="" class="spinner_load hidden animate-spin h-5 w-5 text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span class="text_simpan">Simpan Perubahan</span>
                </button>
            </div>
        </form>


        {{-- Form Hapus Foto Profile --}}
        <form class="hidden" id="deleteProfilePicture" action="/foto-profile/{{ Auth::user()->id }}" method="POST">
            @csrf
            @method('DELETE')
        </form>

    </section>
@endsection
