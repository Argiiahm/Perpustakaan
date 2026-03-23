@extends('layouts.index')

@section('halaman', 'Pemberitahuan')
@section('suffix', 'Anda!')

@section('main')


    {{-- Detail Pesan MAsuk --}}
    <section class="mt-20 w-full max-w-[800px]">
        <div class="bg-[#FFFFFF] p-6">
            {{-- HEADER --}}
            <span class="text-[16px] text-[#35094D]">
                Dear <span class="font-semibold">{{ Auth::user()->Anggota->nama_lengkap ?? Auth::user()->username }}!</span>
            </span>

            {{-- BODY --}}
            <div class="w-full max-w-[400px] my-6">
                <span>
                    {!! nl2br(e($pemberitahuan->pesan)) !!}
                </span>
            </div>

            {{-- FOOTER --}}
            <span class="text-[16px] text-[#35094D]">
                From <span class="font-semibold">Petugas Perpustakaan.</span>
            </span>

            <div class="flex justify-end mt-6 gap-2">
                <button onclick="window.history.back()" class="border border-gray-200 py-2 px-6 text-[#35094D] rounded-md">
                    Kembali
                </button>

                @if (!$pemberitahuan->sudah_dilihat)
                    <form action="/pemberitahuan/read/{{ $pemberitahuan->id  }}" method="POST">
                        @csrf
                        <button type="submit" class="cursor-pointer bg-[#35094D] text-white py-2 px-6 rounded-md">
                            Tandai Sudah Dibaca
                        </button>
                    </form>
                @else
                    <span class="text-green-600 font-medium py-2 px-6">Sudah Dibaca</span>
                @endif
            </div>
        </div> 
    </section>
@endsection
