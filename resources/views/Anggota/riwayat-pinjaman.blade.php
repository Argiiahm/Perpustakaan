@extends('layouts.index')

@section('halaman', 'Riwayat Pinjaman')
@section('suffix', 'Anda!')

@section('main')


    {{-- Table Pinjaman Aktif, Pending Dan Kembalikan(Pending) --}}
    <section class="mt-10">
        <div class="bg-white w-full rounded-xl mt-4 p-6">
            <div class="font-medium pb-4">Aktif</div>
            {{-- Table Riwayat Aktif (Pending Dan Aktif) --}}
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-gray-200">
                        <th class="pb-4 text-center text-gray-400 font-normal">Kode Buku</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Judul Buku</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tanggal Pinjam</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tanggal Jatuh Tempo</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Detail</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Status Peminjaman</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Status Pengembalian</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[#35094D]">
                    {{-- POV MASIH TERPINJAM --}}
                    @forelse ($pengajuans as $pengajuan)
                        <tr class="border-b border-gray-200">
                            <td class="py-4 text-center">{{ $pengajuan->buku->kode_buku }}</td>
                            <td class="py-4 text-center">{{ $pengajuan->buku->judul_buku }}</td>
                            <td class="py-4 text-center">{{ $pengajuan->tanggal_pinjam }}</td>
                            @if ($pengajuan->status === 'menunggu')
                                <td class="py-4 text-center text-[#35094D66]">Menunggu...</td>
                            @else
                                @php
                                    $isTerlambat = \Carbon\Carbon::now()->gt(
                                        \Carbon\Carbon::parse($pengajuan->tanggal_jatuh_tempo),
                                    );
                                @endphp
                                <td class="py-4 text-center {{ $isTerlambat ? 'text-red-500 font-semibold' : '' }}">
                                    {{ $pengajuan->tanggal_jatuh_tempo }}</td>
                            @endif
                            <td class="py-4">
                                <div class="flex justify-center">
                                    <button class="openModalDetailPengajuan" data-id="{{ $pengajuan->id }}"
                                        data-nomer_induk="{{ $pengajuan->anggota->nomer_induk }}"
                                        data-nama="{{ $pengajuan->anggota->nama_lengkap }}"
                                        data-jk="{{ $pengajuan->anggota->jenis_kelamin }}"
                                        data-alamat="{{ $pengajuan->anggota->alamat }}"
                                        data-tgl_pinjam="{{ $pengajuan->tanggal_pinjam }}"
                                        data-tgl_tempo="{{ $pengajuan->tanggal_jatuh_tempo }}"
                                        data-status="{{ $pengajuan->status }}"
                                        data-kode_buku="{{ $pengajuan->buku->kode_buku }}"
                                        data-judul_buku="{{ $pengajuan->buku->judul_buku }}"
                                        data-penulis="{{ $pengajuan->buku->penulis }}"
                                        data-thn_terbit="{{ $pengajuan->buku->tahun_terbit }}" type="button"
                                        class="flex justify-center cursor-pointer">
                                        <img src="{{ asset('icons/svg/detail.svg') }}" alt="">
                                    </button>
                                </div>
                            </td>
                            <td class="py-4 text-center">
                                @if ($pengajuan->status === 'menunggu')
                                    <span class="bg-[#f99c2272] text-white px-6 py-2 rounded-full">
                                        {{ $pengajuan->status }}
                                    </span>
                                @else
                                    <span class="bg-[#16C09861] text-[#008767] px-6 py-2 rounded-full">
                                        {{ $pengajuan->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 text-center">
                                @if (optional($pengajuan->pengembalian)->status === 'menunggu')
                                    <span class="bg-[#f99c2272] text-white px-6 py-2 rounded-full">
                                        menunggu konfirmasi
                                    </span>
                                @else
                                    <span class="px-6 py-2 rounded-full">
                                        -
                                    </span>
                                @endif
                            </td>
                            {{-- Tombol Kembalikan --}}
                            <td class="py-4 text-center">
                                @if ($pengajuan->status === 'menunggu')
                                    -
                                @elseif (optional($pengajuan->pengembalian)->status === 'menunggu')
                                    <button class="bg-gray-200 cursor-no-drop text-white px-6 py-2 rounded-full">
                                        Menunggu..
                                    </button>
                                @else
                                    <button type="button" data-id="{{ $pengajuan->id }}"
                                        class="btn_open_modal_kembalikan bg-[#35094D] cursor-pointer text-white px-6 py-2 rounded-full">
                                        Kembalikan
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $pengajuans->links() }}
            </div>
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

    {{-- Modal Kembalikan --}}
    <section class="open_modal_kembalikan hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>

        <div
            class="relative bg-white w-full max-w-sm rounded-[2rem] shadow-2xl overflow-hidden transform transition-all scale-100 ring-1 ring-black/5">
            <div class="p-8">
                <div class="relative w-24 h-24 mx-auto mb-6">
                    <div class="absolute inset-0 bg-[#35094D]/10 rounded-full"></div>
                    <div class="relative w-full h-full bg-[#35094D]/5 rounded-full flex items-center justify-center">
                        <img class="w-12 h-12" src="{{ asset('icons/svg/ajukan-jadwal.svg') }}" alt="">
                    </div>
                </div>

                <div class="text-center mb-8">
                    <h2 class="text-[#35094D] text-2xl font-bold tracking-tight mb-2">Kembalikan Buku?</h2>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Pastikan kondisi buku dalam keadaan baik saat dikembalikan ke perpustakaan.
                    </p>
                </div>

                <div class="flex flex-col gap-3">
                    <form class="all_form form_kembalikan" method="POST">
                        @csrf
                        <button type="submit"
                            class="btn_simpan_perubahan w-full bg-[#35094D] hover:bg-[#4a0d6b] active:scale-[0.98] text-white font-semibold py-4 rounded-2xl shadow-lg shadow-[#35094D]/20 transition-all flex items-center justify-center gap-3">

                            <svg class="spinner_load hidden animate-spin h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>

                            <span class="text_simpan">Ya, Kembalikan Sekarang</span>
                        </button>
                    </form>
                    <button
                        class="btn_close_kembalikan w-full border-2 border-slate-100 text-slate-500 font-medium py-4 rounded-2xl hover:bg-slate-50 hover:text-slate-700 transition-all active:scale-[0.98]">
                        Mungkin Nanti
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal Detail --}}
    @include('components.modal-detail-pengajuan')


    <script>
        const openModalKembalikan = document.querySelectorAll('.btn_open_modal_kembalikan');
        const ModalKembalikan = document.querySelector('.open_modal_kembalikan');
        const CloseKembalikan = document.querySelector('.btn_close_kembalikan')
        const formKembalikan = document.querySelector('.form_kembalikan');

        openModalKembalikan.forEach(btn => {
            btn.addEventListener("click", function() {
                const id = this.dataset.id;
                ModalKembalikan.classList.remove('hidden');
                formKembalikan.action = `/kembalikan-buku/${id}`;
            });
        });

        CloseKembalikan.addEventListener("click", function() {
            ModalKembalikan.classList.add('hidden');
        });
    </script>

@endsection
