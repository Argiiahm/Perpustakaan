@extends('layouts.index')

@section('halaman', 'Kelola Buku')

@section('main')


    {{-- Filter --}}
    <section class="mt-20 mb-8 flex justify-between items-center">
        <div>
            <a href="/kelola-buku/tambah-buku" class="flex items-center gap-2 mt-6 border text-white bg-[#35094D] px-6 py-3 rounded-md">
                <img src="{{ asset('icons/svg/add-buku-icon.svg') }}" alt="">
                <span>Tambah Buku</span>
            </a>
        </div>
        <div class="">
            <form action="" method="GET" class="form-cari flex items-center gap-2">
                @csrf
                <div class="relative w-full max-w-[450px]">
                    <div class="absolute inset-y-0 left-4 flex items-center">
                        <img src="{{ asset('icons/svg/Search.svg') }}" alt="">
                    </div>
                    <input name="cari" type="text" placeholder="Cari kode buku, judul buku...."
                        class="bg-white w-full pl-12 pr-4 py-3 rounded-md placeholder:text-gray-300 border border-gray-200"
                        value="{{ request('cari') }}">
                </div>
                <button type="submit"
                    class="bg-[#35094D] text-white px-6 py-3 rounded-md hover:bg-[#2a073a] transition duration-300 cursor-pointer">Cari</button>
            </form>
        </div>
    </section>

    {{-- Table Pinjaman Aktif, Pending Dan Kembalikan(Pending) --}}
    <section>
        <div class="bg-white w-full rounded-xl mt-4 p-6">
            <div class="font-medium pb-4">Aktif</div>
            {{-- Table Riwayat Aktif (Pending Dan Aktif) --}}
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-gray-200">
                        <th class="pb-4 text-center text-gray-400 font-normal">Cover</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Kode Buku</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Judul Buku</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Penulis</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tahun Terbit</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Stok Buku</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[#35094D]">
                    <tr class="border-b border-gray-200">
                        <td class="py-4 flex justify-center">
                            <img class="w-10"
                                src="https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1516602134i/36393774.jpg"
                                alt="">
                        </td>
                        <td class="py-4 text-center">BOOK00912</td>
                        <td class="py-4 text-center">Laut Bercerita</td>
                        <td class="py-4 text-center">Leila C</td>
                        <td class="py-4 text-center">1/2/2026</td>
                        <td class="py-4 text-center">
                            <span class="bg-[#16C09861] text-[#008767] px-6 py-2 rounded-full">
                                5
                            </span>
                        </td>
                        {{-- Tombol Kembalikan --}}
                        <td class="py-4 text-center">
                            <button
                                class="btn_open_modal_kembalikan bg-[#F99D2282] cursor-pointer text-white px-6 py-2 rounded-full">
                                Edit
                            </button>
                            <button
                                class="btn_open_modal_kembalikan bg-[#FFC5C5] cursor-pointer text-white px-6 py-2 rounded-full">
                                Hapus
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection
