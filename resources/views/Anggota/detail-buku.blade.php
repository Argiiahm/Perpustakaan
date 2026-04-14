@extends('layouts.index')

@section('halaman', 'Detail Buku - ' . $buku->kode_buku)

@section('main')

    {{-- Container Utama --}}
    <section class="mt-20 px-6">

        {{-- Card Utama --}}
        <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden">
            <div class="flex flex-col md:flex-row gap-10 p-8 md:p-12">

                <div class="">
                    <img class="w-64 rounded-2xl object-cover"
                        src="{{ $buku->cover_buku ? asset('storage/' . $buku->cover_buku) : asset('icons/no-image.jpg') }}"
                        alt="{{ $buku->judul_buku ?? 'Cover Buku' }}">
                </div>

                {{-- Informasi & Sinopsis --}}
                <div class="w-full flex flex-col">
                    <div class="mb-6">
                        <span
                            class="text-[#35094D] font-bold tracking-widest text-xs uppercase opacity-60">{{ $buku->kode_buku ?? 'N/A' }}</span>
                        <h1 class="text-[#35094D] font-extrabold text-4xl mt-2">
                            {{ $buku->judul_buku ?? 'Tidak Ada Judul.' }}</h1>
                        <p class="text-gray-500 text-lg mt-2 font-medium">Karya <span
                                class="text-[#35094D]">{{ $buku->penulis ?? 'Penulis Anonim' }}</span></p>
                    </div>

                    <hr class="border-gray-100 mb-8">

                    {{-- Section Sinopsis --}}
                    <div class="mb-10">
                        <h3 class="text-[#35094D] font-bold text-xl mb-3 flex items-center gap-2">
                            <img src="{{ asset('icons/svg/buku-aktif.svg') }}" alt="">
                            Sinopsis Buku
                        </h3>
                        <p class="text-gray-600 leading-relaxed text-justify italic">
                            {{ $buku->sinopsis ?? 'Belum ada sinopsis untuk buku ini. Silakan hubungi pustakawan untuk informasi lebih lanjut mengenai isi buku.' }}
                        </p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mb-10">
                        <div class="bg-gray-50 p-4 rounded-2xl">
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Tahun Terbit</p>
                            <p class="font-bold text-[#35094D]">{{ $buku->tahun_terbit ?? '-' }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-2xl">
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Stok Tersedia</p>
                            <p class="font-bold text-[#35094D]">{{ $buku->stok_buku ?? 0 }} Tersedia</p>
                        </div>
                    </div>

                    {{-- Action Button --}}
                    <div class="mt-auto flex gap-4">
                        {{-- Jika Status Menunggu --}}
                        @if ($pending)
                            <button type="button"
                                class="flex-1 bg-[#35094d52] text-white font-bold cursor-no-drop py-4 rounded-2xl transition-all flex items-center justify-center gap-3">
                                <img src="{{ asset('icons/svg/ajukan-jadwal.svg') }}" class="w-5 h-5 brightness-0 invert"
                                    alt="">
                                <span>Menunggu...</span>
                            </button>
                        @elseif ($dipinjam)
                            {{-- Sedang Dipinjam --}}
                            <button type="button"
                                class="flex-1 bg-[#35094d52] text-white font-bold cursor-no-drop py-4 rounded-2xl transition-all flex items-center justify-center gap-3">
                                <img src="{{ asset('icons/svg/ajukan-jadwal.svg') }}" class="w-5 h-5 brightness-0 invert"
                                    alt="">
                                <span>Sedang Anda Pinjam</span>
                            </button>
                        @else
                            {{-- Jika Tidak --}}
                            <button type="button"
                                class="btn_open_modal_ajukan flex-1 bg-[#35094D] hover:bg-[#4d126b] text-white font-bold py-4 rounded-2xl transition-all flex items-center justify-center gap-3">
                                <img src="{{ asset('icons/svg/ajukan-jadwal.svg') }}" class="w-5 h-5 brightness-0 invert"
                                    alt="">
                                <span>Pinjam Buku Sekarang</span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal Ajukan --}}
    <section
        class="open_modal_ajukan hidden fixed inset-0 bg-[#0F172A]/60 backdrop-blur-md flex justify-center items-center z-50 p-4 transition-all">
        <div class="bg-white w-full max-w-md rounded-3xl overflow-hidden transform transition-all scale-100">
            <div class="p-8 text-center">
                <div class="w-20 h-20 bg-[#35094D]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <img class="w-12" src="{{ asset('icons/svg/ajukan-jadwal.svg') }}" alt="">
                </div>
                <h2 class="text-[#35094D] text-2xl font-extrabold mb-2">Konfirmasi Pinjaman</h2>
                <p class="text-gray-500 mb-6">Apakah kamu yakin ingin mengajukan peminjaman buku <span
                        class="font-bold text-gray-700">"{{ $buku->judul_buku }}"</span>?</p>

                <form class="all_form" action="/ajukan-buku" method="POST">
                    @csrf
                    <input type="hidden" name="buku_id" value="{{ $buku->id }}">

                    <div class="text-left flex flex-col gap-4 mb-8">
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase ml-1">Tanggal Pinjam</label>
                            <input type="date" value="{{ date('Y-m-d') }}" disabled
                                class="w-full bg-gray-100 border-none text-gray-500 rounded-xl py-3 px-4 mt-1 cursor-not-allowed">
                            <input type="hidden" name="tanggal_pinjam" value="{{ date('Y-m-d') }}">
                        </div>

                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase ml-1">Target Pengembalian (Max 30 Hari)</label>
                            <input type="date" name="tanggal_jatuh_tempo" required min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+30 days')) }}"
                                class="w-full bg-gray-50 border-2 border-gray-100 focus:border-[#35094D] focus:ring-0 text-gray-700 rounded-xl py-3 px-4 mt-1 transition-all">
                        </div>
                    </div>

                    <div class="flex flex-col gap-3">
                        <button type="submit"
                            class="btn_simpan_perubahan w-full bg-[#35094D] text-white font-bold py-4 rounded-xl transition-all flex items-center justify-center gap-2">
                            <svg class="spinner_load hidden animate-spin h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span class="text_simpan">Ya, Konfirmasi Pinjaman</span>
                        </button>

                        <button type="button"
                            class="btn_close_ajukan w-full border-2 border-gray-100 text-gray-400 font-bold py-4 rounded-xl hover:bg-gray-50 transition-all">
                            Batalkan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
