@extends('layouts.index')

@section('halaman', 'Dashboard')
@section('suffix', 'Anda!')

@section('main')

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
                <span class="text-5xl text-[#FFFFFF]">{{ $jumlah_buku }}</span>
                <span class="text-[#FFFFFF90] text-[10px]">
                    *Menampilkan Jumlah Keseluruhan <br> Buku
                </span>
            </div>
        </div>
        {{-- Jumlah Keseluruhan Pengajuan --}}
        <div class="bg-[#4C5EFD] p-6 rounded-[32px]">
            <div class="flex flex-col gap-4">
                <span class="text-[20px] text-[#FFFFFF]">Jumlah Keseluruhan <br> Peminjaman</span>
                <span class="text-5xl text-[#FFFFFF]">{{ $jumlah_peminjaman }}</span>
                <span class="text-[#FFFFFF90] text-[10px]">
                    *Menampilkan Jumlah Keseluruhan <br> Peminjaman
                </span>
            </div>
        </div>
        {{-- Jumlah Keseluruhan Pengembalian --}}
        <div class="bg-[#31CEA8] p-6 rounded-[32px]">
            <div class="flex flex-col gap-4">
                <span class="text-[20px] text-[#FFFFFF]">Jumlah Keseluruhan <br> Pengembalian</span>
                <span class="text-5xl text-[#FFFFFF]">{{ $jumlah_pengembalian }}</span>
                <span class="text-[#FFFFFF90] text-[10px]">
                    *Menampilkan Jumlah Keseluruhan <br> Pengembalian
                </span>
            </div>
        </div>
    </section>
@endsection