@extends('layouts.index')

@section('main')
    {{-- Header --}}
    <section>
        <h1 class="text-[30px] text-[#35094D]">Hallo, <span
                class="font-semibold">{{ Auth::user()->Anggota->nama_lengkap ?? Auth::user()->username }}</span></h1>
        <span class="text-[#35094d90]">Selamat Datang Kembali Di Halaman <span class="font-medium text-[#35094D]">
                Detail Buku - #BOOK200202</span></span>
    </section>

    {{-- Bg Belkng --}}
    <section class="bg-[#FFFFFF] mt-36 px-14">
        {{-- Header Cover Buku --}}
        <div>
            <div class="flex gap-4 transform -translate-y-20">
                <img class="w-40"
                    src="https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1516602134i/36393774.jpg"
                    alt="">
                <div class="">
                    <h1 class="text-[#35094D] font-semibold text-[30px]">Laut Bercerita</h1>
                    <span class="text-[#B5B7C0] font-medium">Leila S. Chudori</span>
                </div>
            </div>

            {{-- Detail Buku Lainya --}}
            <div class="grid grid-cols-3 gap-6 -mt-8">
                {{-- Kode Buku --}}
                <div class="flex flex-col">
                    <div class="flex items-center gap-1">
                        <span class="font-semibold text-[#35094D]">#</span>
                        <span class="font-semibold text-[#35094D]">Kode Buku : </span>
                    </div>
                    <span class="font-medium text-[#35094D6B]">BOOK200202</span>
                </div>
                {{-- Judul Buku --}}
                <div class="flex flex-col">
                    <div class="flex items-center gap-1">
                        <img src="{{ asset('icons/svg/judul-buku.svg') }}" alt="">
                        <span class="font-semibold text-[#35094D]">Judul Buku : </span>
                    </div>
                    <span class="font-medium text-[#35094D6B]">Laut Bercerita</span>
                </div>
                {{-- Stok Buku --}}
                <div class="flex flex-col">
                    <div class="flex items-center gap-1">
                        <img src="{{ asset('icons/svg/stock.svg') }}" alt="">
                        <span class="font-semibold text-[#35094D]">Stok Buku : </span>
                    </div>
                    <span class="font-medium text-[#35094D6B]">10</span>
                </div>
                {{-- Tahun Terbit Buku --}}
                <div class="flex flex-col">
                    <div class="flex items-center gap-1">
                        <img src="{{ asset('icons/svg/calendar.svg') }}" alt="">
                        <span class="font-semibold text-[#35094D]">Tahun Terbit : </span>
                    </div>
                    <span class="font-medium text-[#35094D6B]">1/1/2017</span>
                </div>
                {{-- Penulis Buku --}}
                <div class="flex flex-col">
                    <div class="flex items-center gap-1">
                        <img src="{{ asset('icons/svg/penulis.svg') }}" alt="">
                        <span class="font-semibold text-[#35094D]">Penulis : </span>
                    </div>
                    <span class="font-medium text-[#35094D6B]">Leila S. Chudori</span>
                </div>
            </div>
            {{-- Button Ajukan Jadwal --}}
            <div class="py-10 flex justify-end">
                <button id="btn_open_modal"
                    class="bg-[#35094D] text-white px-8 py-3 rounded-full cursor-pointer mt-4 flex items-center gap-2">
                    <img src="{{ asset('icons/svg/ajukan-jadwal.svg') }}" alt="">
                    <span>Ajukan Jadwal</span>
                </button>
            </div>
        </div>
    </section>

    {{-- Modal Ajukan Buku --}}
    <section id="open_modal"
        class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm flex justify-center items-center z-50">
        <div class="bg-white p-4 w-full max-w-[32rem] rounded-xl">
            {{-- Keterangan Modal --}}
            <div class="flex flex-col items-center gap-4">
                <img class="w-52" src="{{ asset('icons/logo-modal-1.png') }}" alt="">
                <span class="text-[#35094D] font-bold">Ingin Ajukan Pinjaman Buku Ini?</span>
            </div>
            {{-- Action Buttons --}}
            <div class="flex justify-center gap-4 my-6">
                <button id="btn_close"
                    class="border border-gray-200 text-[#35094D] px-10 py-2 rounded-full cursor-pointer">Nanti Saja</button>
                <form action="">
                    @csrf
                    <button class="bg-[#35094D] text-white px-10 py-2 rounded-full cursor-pointer">Ya, Pinjam</button>
                </form>
            </div>
        </div>
    </section>
@endsection
