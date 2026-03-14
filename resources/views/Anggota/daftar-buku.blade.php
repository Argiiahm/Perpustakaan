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
        {{-- Menampilakn 5 Data Per Baris --}}
        <section class="grid grid-cols-5 gap-6">
            {{-- Card Buku --}}
            <div class="transform translate-y-[-30%] bg-[#FFFFFF] w-fit p-2 shadow-sm shadow-gray-100">
                <a href="/detail-buku">
                    <img class="w-36"
                        src="https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1516602134i/36393774.jpg"
                        alt="">
                    <div class="flex flex-col mt-2">
                        <span class="font-semibold text-[20px] text-[#35094D]">Laut Bercerita</span>
                        <span class="font-medium text-[12px] text-[#757575]">Penulis: Tere Liye</span>
                    </div>
                </a>
            </div>
            <a href="/detail-buku" class="transform translate-y-[-30%] bg-[#FFFFFF] w-fit p-2 shadow-sm shadow-gray-100">
                <img class="w-36"
                    src="https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1516602134i/36393774.jpg"
                    alt="">
                <div class="flex flex-col mt-2">
                    <span class="font-semibold text-[20px] text-[#35094D]">Laut Bercerita</span>
                    <span class="font-medium text-[12px] text-[#757575]">Penulis: Tere Liye</span>
                </div>
            </a>
            {{-- End Card Buku --}}
            {{-- Card Buku --}}
            <a href="" class="transform translate-y-[-30%] bg-[#FFFFFF] w-fit p-2 shadow-sm shadow-gray-100">
                <img class="w-36"
                    src="https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1516602134i/36393774.jpg"
                    alt="">
                <div class="flex flex-col mt-2">
                    <span class="font-semibold text-[20px] text-[#35094D]">Laut Bercerita</span>
                    <span class="font-medium text-[12px] text-[#757575]">Penulis: Tere Liye</span>
                </div>
            </a>
            {{-- End Card Buku --}}
            {{-- Card Buku --}}
            <a href="" class="transform translate-y-[-30%] bg-[#FFFFFF] w-fit p-2 shadow-sm shadow-gray-100">
                <img class="w-36"
                    src="https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1516602134i/36393774.jpg"
                    alt="">
                <div class="flex flex-col mt-2">
                    <span class="font-semibold text-[20px] text-[#35094D]">Laut Bercerita</span>
                    <span class="font-medium text-[12px] text-[#757575]">Penulis: Tere Liye</span>
                </div>
            </a>
            {{-- End Card Buku --}}
            {{-- Card Buku --}}
            <a href="" class="transform translate-y-[-30%] bg-[#FFFFFF] w-fit p-2 shadow-sm shadow-gray-100">
                <img class="w-36"
                    src="https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1516602134i/36393774.jpg"
                    alt="">
                <div class="flex flex-col mt-2">
                    <span class="font-semibold text-[20px] text-[#35094D]">Laut Bercerita</span>
                    <span class="font-medium text-[12px] text-[#757575]">Penulis: Tere Liye</span>
                </div>
            </a>
            {{-- End Card Buku --}}
            {{-- Card Buku --}}
            <a href="" class="transform translate-y-[-30%] bg-[#FFFFFF] w-fit p-2 shadow-sm shadow-gray-100">
                <img class="w-36"
                    src="https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1516602134i/36393774.jpg"
                    alt="">
                <div class="flex flex-col mt-2">
                    <span class="font-semibold text-[20px] text-[#35094D]">Laut Bercerita</span>
                    <span class="font-medium text-[12px] text-[#757575]">Penulis: Tere Liye</span>
                </div>
            </a>
            {{-- End Card Buku --}}
            {{-- Card Buku --}}
            <a href="" class="transform translate-y-[-30%] bg-[#FFFFFF] w-fit p-2 shadow-sm shadow-gray-100">
                <img class="w-36"
                    src="https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1516602134i/36393774.jpg"
                    alt="">
                <div class="flex flex-col mt-2">
                    <span class="font-semibold text-[20px] text-[#35094D]">Laut Bercerita</span>
                    <span class="font-medium text-[12px] text-[#757575]">Penulis: Tere Liye</span>
                </div>
            </a>
            {{-- End Card Buku --}}
            {{-- Card Buku --}}
            <a href="" class="transform translate-y-[-30%] bg-[#FFFFFF] w-fit p-2 shadow-sm shadow-gray-100">
                <img class="w-36"
                    src="https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1516602134i/36393774.jpg"
                    alt="">
                <div class="flex flex-col mt-2">
                    <span class="font-semibold text-[20px] text-[#35094D]">Laut Bercerita</span>
                    <span class="font-medium text-[12px] text-[#757575]">Penulis: Tere Liye</span>
                </div>
            </a>
            {{-- End Card Buku --}}
            {{-- Card Buku --}}
            <a href="" class="transform translate-y-[-30%] bg-[#FFFFFF] w-fit p-2 shadow-sm shadow-gray-100">
                <img class="w-36"
                    src="https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1516602134i/36393774.jpg"
                    alt="">
                <div class="flex flex-col mt-2">
                    <span class="font-semibold text-[20px] text-[#35094D]">Laut Bercerita</span>
                    <span class="font-medium text-[12px] text-[#757575]">Penulis: Tere Liye</span>
                </div>
            </a>
            {{-- End Card Buku --}}
            {{-- Card Buku --}}
            <a href="" class="transform translate-y-[-30%] bg-[#FFFFFF] w-fit p-2 shadow-sm shadow-gray-100">
                <img class="w-36"
                    src="https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1516602134i/36393774.jpg"
                    alt="">
                <div class="flex flex-col mt-2">
                    <span class="font-semibold text-[20px] text-[#35094D]">Laut Bercerita</span>
                    <span class="font-medium text-[12px] text-[#757575]">Penulis: Tere Liye</span>
                </div>
            </a>
            {{-- End Card Buku --}}
        </section>
    </section>
@endsection