@extends('layouts.index')

@section('halaman', 'Pemberitahuan')
@section('suffix', 'Anda!')

@section('main')
    {{-- Daftar Pesan MAsuk --}}
    <section class="mt-20">
        @forelse ($pemberitahuans as $pemberitahuan)
            {{-- Card Pesan --}}
            <div class="flex justify-between items-center {{ $pemberitahuan->sudah_dilihat ? 'bg-gray-400' : 'bg-[#FFFFFF]'  }} px-4 py-2 my-4">
                <div class="flex items-center gap-4">
                    {{-- Icon MaIl --}}
                    <img src="{{ asset('icons/svg/mail.svg') }}" alt="">
                    {{-- Text Ketetngan Pesan --}}
                    <span class="text-[16px] text-[#35094D66]">{{ Str::limit($pemberitahuan->pesan, 100) }}</span>
                </div>
                {{-- Action Detail --}}
                <div>
                    <a class="text-[#35094D]" href="/pemberitahuan/detail/{{ $pemberitahuan->id }}">Lihat Detail</a>
                </div>
            </div>
        @empty
            <div class="text-center mt-10 text-gray-400">
                <p class="text-lg">Tidak ada pemberitahuan</p>
                <p class="text-sm">Semua notifikasi akan muncul di sini</p>
            </div>
        @endforelse
    </section>
@endsection
