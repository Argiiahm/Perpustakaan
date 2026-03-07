@extends('layouts.index')

@section('main')

    {{-- Header --}}
    <section>
        <h1 class="text-[30px] text-[#35094D]">Hallo, <span class="font-semibold">{{ Auth::user()->KepalaPerpus->nama_lengkap ?? Auth::user()->username }}</span></h1>
        <span class="text-[#35094d90]">Selamat Datang Kembali Di Halaman <span class="font-medium text-[#35094D]">Dashboard</span> Anda!</span>
    </section>

    {{-- Informasi --}}
    <section class="grid grid-cols-3 gap-6 my-16">
        {{-- Jumlah Keseluruhan Anggota --}}
        <div class="bg-[#35094D] p-6 rounded-[32px]">
            <div class="flex flex-col gap-4">
                <span class="text-[20px] text-[#FFFFFF]">Jumlah Keseluruhan <br> Anggota</span>
                <span class="text-5xl text-[#FFFFFF]">{{ $Jumlah_Anggota }}</span>
                <span class="text-[#FFFFFF90] text-[10px]">
                    *Menampilkan Jumlah Keseluruhan <br> Anggota
                </span>
            </div>
        </div>
        {{-- Jumlah Keseluruhan Petugas --}}
        <div class="bg-[#F99D22] p-6 rounded-[32px]">
            <div class="flex flex-col gap-4">
                <span class="text-[20px] text-[#FFFFFF]">Jumlah Keseluruhan <br> Petugas</span>
                <span class="text-5xl text-[#FFFFFF]">{{ $Jumlah_Petugas }}</span>
                <span class="text-[#FFFFFF90] text-[10px]">
                    *Menampilkan Jumlah Keseluruhan <br> Petugas
                </span>
            </div>
        </div>
        {{-- Jumlah Keseluruhan Buku --}}
        <div class="bg-[#0B4B88] p-6 rounded-[32px]">
            <div class="flex flex-col gap-4">
                <span class="text-[20px] text-[#FFFFFF]">Jumlah Keseluruhan <br> Buku</span>
                <span class="text-5xl text-[#FFFFFF]">9</span>
                <span class="text-[#FFFFFF90] text-[10px]">
                    *Menampilkan Jumlah Keseluruhan <br> Buku
                </span>
            </div>
        </div>
        {{-- Jumlah Keseluruhan Pengajuan --}}
        <div class="bg-[#4C5EFD] p-6 rounded-[32px]">
            <div class="flex flex-col gap-4">
                <span class="text-[20px] text-[#FFFFFF]">Jumlah Keseluruhan <br> Pengajuan</span>
                <span class="text-5xl text-[#FFFFFF]">9</span>
                <span class="text-[#FFFFFF90] text-[10px]">
                    *Menampilkan Jumlah Keseluruhan <br> Pengajuan
                </span>
            </div>
        </div>
        {{-- Jumlah Keseluruhan Pengembalian --}}
        <div class="bg-[#31CEA8] p-6 rounded-[32px]">
            <div class="flex flex-col gap-4">
                <span class="text-[20px] text-[#FFFFFF]">Jumlah Keseluruhan <br> Pengembalian</span>
                <span class="text-5xl text-[#FFFFFF]">9</span>
                <span class="text-[#FFFFFF90] text-[10px]">
                    *Menampilkan Jumlah Keseluruhan <br> Pengembalian
                </span>
            </div>
        </div>
    </section>



@endsection