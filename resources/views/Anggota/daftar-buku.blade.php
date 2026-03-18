@extends('layouts.index')

@section('halaman', 'Daftar Buku')

@section('main')

    {{-- Header & Filter Cari --}}
    <section class="px-10 pt-20">
            <form action="/daftar-buku" method="GET" class="form-cari flex flex-col gap-4">
                @csrf
                <div class="relative w-full max-w-[600px]">
                    <div class="absolute inset-y-0 left-4 flex items-center">
                        <img src="{{ asset('icons/svg/Search.svg') }}" class="w-5 opacity-50" alt="">
                    </div>
                    <input name="cari" type="text" placeholder="Cari Judul Buku, Penulis..."
                        class="bg-white w-full pl-12 pr-4 py-4 rounded-2xl outline-0 border border-gray-50" value="{{ request('cari') }}">
                </div>
            </form>
    </section>

    <section class="w-full bg-white mt-32 px-10 pb-20 min-h-[500px]">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @forelse ($Bukus as $buku)
                <div class="transform -translate-y-16">
                    <a href="/daftar-buku/detail-buku={{ $buku->id }}" class="block bg-white p-3 rounded-xl shadow-lg hover:shadow-2xl transition-shadow border border-gray-50">
                        
                        {{-- Cover Buku --}}
                        <div class="overflow-hidden rounded-lg aspect-[3/4]">
                            <img class="w-full h-full object-cover"
                                src="{{ $buku->cover_buku ? asset('storage/' . $buku->cover_buku) : asset('icons/no-image.jpg') }}"
                                alt="{{ $buku->judul_buku ?? 'cover' }}">
                        </div>

                        {{-- Info Buku --}}
                        <div class="mt-4 flex flex-col">
                            <span class="font-bold text-[16px] text-[#35094D]">
                                {{ $buku->judul_buku ?? 'Tidak Ada Judul.' }}
                            </span>
                            <span class="font-medium text-[11px] text-[#B5B7C0]">
                                {{ $buku->penulis ?? 'Anonim' }}
                            </span>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <p class="text-gray-400 italic">Buku tidak ditemukan...</p>
                </div>
            @endforelse

        </div>

        {{-- Pagination --}}
        <div class="mt-5">
            {{ $Bukus->links() }}
        </div>
    </section>

@endsection