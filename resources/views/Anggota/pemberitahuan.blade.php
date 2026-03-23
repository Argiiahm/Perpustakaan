@extends('layouts.index')

@section('halaman', 'Pemberitahuan')
@section('suffix', 'Anda!')

@section('main')
    {{-- Daftar Pesan MAsuk --}}
    <section class="mt-20">
        {{-- Card Pesan --}}
        <div class="flex justify-between items-center bg-[#FFFFFF] px-4 py-2 my-4">
            <div class="flex items-center gap-4">
                {{-- Icon MaIl --}}
                <img src="{{ asset('icons/svg/mail.svg') }}" alt="">
                {{-- Text Ketetngan Pesan --}}
                <span class="text-[16px] text-[#35094D66]">Pengembalian Buku Kamu Telat, kamu dikenakan DENDA....</span>
            </div>
            {{-- Action Detail --}}
            <div>
                <a class="text-[#35094D]" href="/pemberitahuan/detail">Lihat Detail</a>
            </div>
        </div>
    </section>
@endsection