@extends('layouts.index')

@section('halaman', 'Riwayat Pinjaman')
@section('suffix', 'Anda!')

@section('main')


    {{-- Filter --}}
    <section class="mt-20 mb-8 flex justify-end">
        <div>
            <input type="date" class="bg-white px-10 text-gray-400 py-2 rounded-4xl">
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
                        <th class="pb-4 text-center text-gray-400 font-normal">Judul Buku</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tanggal Pinjam</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tanggal Jatuh Tempo</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Detail</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Status</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[#35094D]">
                    {{-- POV MASIH TERPINJAM --}}
                    <tr class="border-b border-gray-200">
                        <td class="py-4 flex justify-center">
                            <img class="w-10"
                                src="https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1516602134i/36393774.jpg"
                                alt="">
                        </td>
                        <td class="py-4 text-center">Laut Bercerita</td>
                        <td class="py-4 text-center">20/1/2026</td>
                        <td class="py-4 text-center">1/2/2026</td>
                        <td class="py-4">
                            <div class="flex justify-center">
                                <img class="" src="{{ asset('icons/svg/detail.svg') }}" alt="">
                            </div>
                        </td>
                        <td class="py-4 text-center">
                            <span class="bg-[#16C09861] text-[#008767] px-6 py-2 rounded-full">
                                Dipinjam
                            </span>
                        </td>
                        {{-- Tombol Kembalikan --}}
                        <td class="py-4 text-center">
                            <button
                                class="btn_open_modal_kembalikan bg-[#35094D] cursor-pointer text-white px-6 py-2 rounded-full">
                                Kembalikan
                            </button>
                        </td>
                    </tr>
                    {{-- POW SUDAH MENEKAN TOMBOL KEMBALIKAN --}}
                    <tr class="border-b border-gray-200">
                        <td class="py-4 flex justify-center">
                            <img class="w-10"
                                src="https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1516602134i/36393774.jpg"
                                alt="">
                        </td>
                        <td class="py-4 text-center">Laut Bercerita</td>
                        <td class="py-4 text-center">20/1/2026</td>
                        <td class="py-4 text-center">1/2/2026</td>
                        <td class="py-4">
                            <div class="flex justify-center">
                                <img class="" src="{{ asset('icons/svg/detail.svg') }}" alt="">
                            </div>
                        </td>
                        <td class="py-4 text-center">
                            <span class="bg-[#16C09861] text-[#008767] px-6 py-2 rounded-full">
                                Dipinjam
                            </span>
                        </td>
                        {{-- Ketika Sudah Menekan TOmbol Mengambalikan, Maka Aksi Akan Berubah Menjadi ("Menunggu") Hingga
                        Di Konfirmasi Oleh Petugas. --}}
                        <td class="py-4 text-center">
                            <button class="bg-[#EEEEEE] cursor-no-drop text-[#35094D66] px-6 py-2 rounded-full">
                                Menunggu...
                            </button>
                        </td>
                    </tr>
                    {{-- POW MASIH PENDING --}}
                    <tr class="border-b border-gray-200">
                        <td class="py-4 flex justify-center">
                            <img class="w-10"
                                src="https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1516602134i/36393774.jpg"
                                alt="">
                        </td>
                        <td class="py-4 text-center">Laut Bercerita</td>
                        <td class="py-4 text-center">20/1/2026</td>
                        <td class="py-4 text-center text-[#35094D66]">Menunggu...</td>
                        <td class="py-4">
                            <div class="flex justify-center">
                                <img class="" src="{{ asset('icons/svg/detail.svg') }}" alt="">
                            </div>
                        </td>
                        <td class="py-4 text-center">
                            <span class="bg-[#F99D2282] text-white px-6 py-2 rounded-full">
                                Pending
                            </span>
                        </td>
                        <td class="py-4 text-center">
                            -
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    {{-- Table Daftar Yang SUdah Di Kembalikan --}}
    <section>
        <div class="bg-white w-full rounded-xl mt-4 p-6">
            <div class="font-medium pb-4">Dikembalikan</div>
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-gray-200">
                        <th class="pb-4 text-center text-gray-400 font-normal">Cover</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Judul Buku</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tanggal Pinjam</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tanggal Jatuh Tempo</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Detail</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Status</th>
                    </tr>
                </thead>
                <tbody class="text-[#35094D]">
                    <tr class="border-b border-gray-200">
                        <td class="py-4 flex justify-center">
                            <img class="w-10"
                                src="https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1516602134i/36393774.jpg"
                                alt="">
                        </td>
                        <td class="py-4 text-center">Laut Bercerita</td>
                        <td class="py-4 text-center">20/1/2026</td>
                        <td class="py-4 text-center">1/2/2026</td>
                        <td class="py-4">
                            <div class="flex justify-center">
                                <img src="{{ asset('icons/svg/detail.svg') }}" alt="">
                            </div>
                        </td>
                        <td class="py-4 text-center">
                            <span class="bg-[#16C09861] text-[#008767] px-6 py-2 rounded-full">
                                Dikembalikan
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    {{-- Modal Kembalikan Buku --}}
    <section
        class="open_modal_kembalikan hidden fixed inset-0 bg-black/40 backdrop-blur-sm flex justify-center items-center z-50">
        <div class="bg-white p-4 w-full max-w-[32rem] rounded-xl">
            {{-- Keterangan Modal --}}
            <div class="flex flex-col items-center gap-4">
                <img class="w-52" src="{{ asset('icons/logo-modal-1.png') }}" alt="">
                <span class="text-[#35094D] font-bold">Ingin Mengembalikan Buku Ini?</span>
            </div>
            {{-- Action Buttons --}}
            <div class="flex justify-center gap-4 my-6">
                <button id=""
                    class="btn_close_kembalikan border border-gray-200 text-[#35094D] px-10 py-2 rounded-full cursor-pointer">Nanti
                    Saja</button>
                <form action="">
                    @csrf
                    <button class="bg-[#35094D] text-white px-10 py-2 rounded-full cursor-pointer">Ya, Kembalikan</button>
                </form>
            </div>
        </div>
    </section>
@endsection