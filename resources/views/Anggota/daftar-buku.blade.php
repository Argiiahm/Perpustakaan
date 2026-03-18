@extends('layouts.index')

@section('halaman', 'Daftar Buku')

@section('main')


    {{-- Filter Cari --}}
    <section>
        <div class="mt-20">
            <div class="flex items-center">
                <div class="relative w-full max-w-[600px]">
                    <div class="absolute inset-y-0 left-4 flex items-center">
                        <img src="{{ asset('icons/svg/Search.svg') }}" alt="">
                    </div>
                    <input type="text" placeholder="Cari Buku Bedasarkan Judul Buku, Penulis..."
                        class="bg-white w-full pl-12 pr-4 py-3 rounded-4xl">
                </div>
            </div>
        </div>
    </section>

    {{-- Bg Belakang --}}
    <section class="w-full bg-[#FFFFFF] mt-32 px-10">
        <section class="grid grid-cols-5 gap-6">
            @forelse ($Bukus as $buku)
                {{-- Card Buku --}}
                <div class="transform translate-y-[-30%] bg-[#FFFFFF] w-fit p-2 shadow-sm shadow-gray-100">
                    <a href="/detail-buku/buku={{ $buku->id }}">
                        <img class="w-36"
                            src="{{ $buku->cover_buku ? asset('storage/' . $buku->cover_buku) : asset('icons/no-image.jpg') }}"
                            alt="{{ $buku->judul_buku ?? 'cover' }}">
                        <div class="flex flex-col mt-2">
                            <span
                                class="font-semibold text-[20px] text-[#35094D]">{{ $buku->judul_buku ?? 'Tidak Ada Judul.' }}</span>
                            <span class="font-medium text-[12px] text-[#757575]">Penulis:
                                {{ $buku->penulis ?? 'Tidak diketahui.' }}</span>
                        </div>
                    </a>
                </div>
                {{-- End Card Buku --}}
            @empty
            @endforelse
        </section>
    </section>

    <div class="mt-5">
        {{ $Bukus->links() }}
    </div>
@endsection
