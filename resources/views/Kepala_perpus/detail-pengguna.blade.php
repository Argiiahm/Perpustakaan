@extends('layouts.index')

@section('halaman')Detail Pengguna - {{ $User->username }}@endsection

@section('main')


    <section class="mt-20">
        {{-- Header --}}
        <div class="flex flex-col mb-5">
            @if ($User->role === 'anggota')
                <span
                    class="font-medium text-[#35094D] text-[24px] capitalize">{{ $User->username }}({{ $User->Anggota->nomer_induk ?? 'Nomer Induk Belum Di Atur.' }})</span>
                <span class="text-gray-400 text-[20px]">{{ $User->role }}#{{ $User->id }}</span>
            @endif
            {{-- @if ($User->role === 'petugas')
            <span class="font-medium text-[#35094D] text-[24px] capitalize">{{ $User->username }}({{
                $User->petugas->nomer_induk }})</span>
            <span class="text-gray-400 text-[20px]">{{ $User->role }}#{{ $User->id }}</span>
            @endif --}}
            @if ($User->role === 'kepala_perpus')
                <span
                    class="font-medium text-[#35094D] text-[24px] capitalize">{{ $User->username }}({{ $User->kepalaPerpus->nomer_induk ?? 'Nomer Induk Belum Di Atur.' }})</span>
                <span class="text-gray-400 text-[20px]">{{ $User->role }}#{{ $User->id }}</span>
            @endif
        </div>
        {{-- Kontn utama detail pengguna --}}
        <div class="flex gap-10">
            <img class="photoPreview w-80 h-80 object-cover border border-gray-200 p-1" id=""
                src="{{ $User->profile_photo ? asset('storage/' . $User->profile_photo) : asset('icons/default-avatar.png') }}"
                alt="">
            <div class="flex gap-40">
                {{-- Basic Data --}}
                <div>
                    <div class="mb-4">
                        <span class="text-[20px] text-[#35094D] font-medium">Username: </span>
                        <span class="block text-[18px] text-gray-400 capitalize">{{ $User->username }}</span>
                    </div>
                    <div class="mb-4">
                        <span class="text-[20px] text-[#35094D] font-medium">Email: </span>
                        <span class="block text-[18px] text-gray-400">{{ $User->email }}</span>
                    </div>
                    <div class="mb-4">
                        <span class="text-[20px] text-[#35094D] font-medium">No Telp: </span>
                        <span class="block text-[18px] text-gray-400">{{ $User->no_telepon }}</span>
                    </div>
                    <div class="mb-4">
                        <span class="text-[20px] text-[#35094D] font-medium">Role: </span>
                        <span class="block text-[18px] text-gray-400">{{ $User->role }}</span>
                    </div>
                    <div class="mb-4">
                        <span class="text-[20px] text-[#35094D] font-medium">Bergabung Pada: </span>
                        <span
                            class="block text-[18px] text-gray-400">{{ $User->created_at->translatedFormat('l, d F Y') }}</span>
                    </div>
                </div>
                {{-- Data Lainya --}}
                <div>
                    <div class="mb-4">
                        <span class="text-[20px] text-[#35094D] font-medium">Nis/Nis: </span>
                        {{-- Anggota - Nomer Induk --}}
                        @if ($User->role === 'anggota')
                            <span class="block text-[18px] text-gray-400">{{ $User->anggota->nomer_induk ?? 'N/A' }}</span>
                        @endif
                        {{-- Petugas - Nomor Induk --}}
                        @if ($User->role === 'petugas')
                            <span class="block text-[18px] text-gray-400">{{ $User->petugas->nomer_induk ?? 'N/A' }}</span>
                        @endif
                        {{-- Kepala Perpus - Nomer Induk --}}
                        @if ($User->role === 'kepala_perpus')
                            <span class="block text-[18px] text-gray-400">{{ $User->KepalaPerpus->nomer_induk ?? 'N/A' }}</span>
                        @endif
                    </div>
                    <div class="mb-4">
                        <span class="text-[20px] text-[#35094D] font-medium">Nama Lengkap: </span>
                        {{-- Anggota - Nama Lengkap --}}
                        @if ($User->role === 'anggota')
                            <span class="block text-[18px] text-gray-400">{{ $User->anggota->nama_lengkap ?? 'N/A' }}</span>
                        @endif
                        {{-- Petugas - Nama Lengkap --}}
                        @if ($User->role === 'petugas')
                            <span class="block text-[18px] text-gray-400">{{ $User->petugas->nama_lengkap ?? 'N/A' }}</span>
                        @endif
                        {{-- Kepala Perpus - Nama Lengkap --}}
                        @if ($User->role === 'kepala_perpus')
                            <span
                                class="block text-[18px] text-gray-400">{{ $User->KepalaPerpus->nama_lengkap ?? 'N/A' }}</span>
                        @endif
                    </div>
                    <div class="mb-4">
                        <span class="text-[20px] text-[#35094D] font-medium">Jenis Kelamin: </span>
                        {{-- Anggota - Jenis Kelamin --}}
                        @if ($User->role === 'anggota')
                            <span class="block text-[18px] text-gray-400">{{ $User->anggota->jenis_kelamin ?? 'N/A' }}</span>
                        @endif
                        {{-- Petugas - Jenis Kelamin --}}
                        @if ($User->role === 'petugas')
                            <span class="block text-[18px] text-gray-400">{{ $User->petugas->jenis_kelamin ?? 'N/A' }}</span>
                        @endif
                        {{-- Kepala Perpus - Jenis Kelamin --}}
                        @if ($User->role === 'kepala_perpus')
                            <span
                                class="block text-[18px] text-gray-400">{{ $User->KepalaPerpus->jenis_kelamin ?? 'N/A' }}</span>
                        @endif
                    </div>
                    <div class="mb-4">
                        <span class="text-[20px] text-[#35094D] font-medium">Tanggal Lahir: </span>
                        {{-- Anggota - Tgl Lahir --}}
                        @if ($User->role === 'anggota')
                            <span class="block text-[18px] text-gray-400">{{ $User->anggota->tanggal_lahir ?? 'N/A' }}</span>
                        @endif
                        {{-- Petugas - Tgl Lahir --}}
                        @if ($User->role === 'petugas')
                            <span class="block text-[18px] text-gray-400">{{ $User->petugas->tanggal_lahir ?? 'N/A' }}</span>
                        @endif
                        {{-- kepala Perpus - Tgl Lahir --}}
                        @if ($User->role === 'kepala_perpus')
                            <span
                                class="block text-[18px] text-gray-400">{{ $User->KepalaPerpus->tanggal_lahir ?? 'N/A' }}</span>
                        @endif
                    </div>
                    <div class="mb-4">
                        <span class="text-[20px] text-[#35094D] font-medium">Alamat Lengkap: </span>
                        {{-- Anggota - Alamat --}}
                        @if ($User->role === 'anggota')
                            <span class="block text-[18px] text-gray-400">{{ $User->anggota->alamat ?? 'N/A' }}</span>
                        @endif
                        {{-- Petugas - Alamat --}}
                        @if ($User->role === 'petugas')
                            <span class="block text-[18px] text-gray-400">{{ $User->petugas->alamat ?? 'N/A' }}</span>
                        @endif
                        {{-- Petugas - Alamat --}}
                        @if ($User->role === 'kepala_perpus')
                            <span class="block text-[18px] text-gray-400">{{ $User->KepalaPerpus->alamat ?? 'N/A' }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-between mt-6">
            <button onclick="window.history.back()"
                class="bg-gray-300 font-medium px-8 py-3 cursor-pointer rounded-lg">Kembali</button>
            <div>
                <button onclick="" class="bg-[#FFC5C5] text-white font-medium px-10 py-3 cursor-pointer rounded-lg">Hapus
                    Akun</button>
                <button onclick="" class="bg-[#F99D2282] text-white font-medium px-10 py-3 cursor-pointer rounded-lg">Edit
                    Akun</button>
            </div>
        </div>
    </section>
@endsection