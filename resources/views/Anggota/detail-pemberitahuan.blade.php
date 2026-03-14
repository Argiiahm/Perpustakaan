@extends('layouts.index')

@section('halaman', 'Pemberitahuan')
@section('suffix', 'Anda!')

@section('main')


    {{-- Detail Pesan MAsuk --}}
    <section class="mt-20 w-full max-w-[800px]">
        <div class="bg-[#FFFFFF] p-6">
            {{-- HEADER --}}
            <span class="text-[16px] text-[#35094D]">Dear <span class="font-semibold">Argiiahm!</span></span>
            {{-- Body --}}
            <div class="w-full max-w-[400px] my-6">
                {{-- <span class="">
                    Pengembalian buku yang Anda pinjam telah melewati batas waktu yang ditentukan. Berdasarkan ketentuan
                    perpustakaan, keterlambatan pengembalian dikenakan denda. Berikut adalah rincian denda yang harus Anda
                    bayar:
                </span>
                <ul class="my-2 mx-4">
                    <li>Judul Buku: Kisah Kita</li>
                    <li>Tanggal Jatuh Tempo: 15/1/2026</li>
                    <li>Tanggal Pengembalian: 15/1/2026</li>
                    <li>Total Denda: Rp 15.000</li>
                </ul> --}}
                <span class="">
                    Pengembalian buku yang Anda pinjam telah melewati batas waktu yang ditentukan. Berdasarkan ketentuan
                    perpustakaan, keterlambatan pengembalian dikenakan denda. Berikut adalah rincian denda yang harus Anda
                    bayar:
                </span>
            </div>
            {{-- FOOTER --}}
            <span class="text-[16px] text-[#35094D]">From <span class="font-semibold">Argiiahm!</span></span>
            {{-- Action --}}
            <div class="flex items-center gap-2 justify-end">
                <button onclick="window.history.back()"
                    class="border border-gray-200 py-2 px-8 text-[#35094D] rounded-md cursor-pointer">Kembali</button>
                <form action="">
                    <button class="bg-[#35094D] text-white py-2 px-8 rounded-md cursor-pointer">Tandai Sudah DiBaca</button>
                </form>
            </div>
        </div>
    </section>
@endsection