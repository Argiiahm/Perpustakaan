@extends('layouts.index')

@section('halaman', 'Daftar pengembalian')

@section('main')


    {{-- Filter --}}
    <section class="mt-20 flex justify-end">
        {{-- Searching --}}
        <form action="/pengembalian" method="GET" class="form-cari flex items-center gap-2">
            <div class="relative w-full max-w-[450px]">
                <div class="absolute inset-y-0 left-4 flex items-center">
                    <img src="{{ asset('icons/svg/Search.svg') }}" alt="">
                </div>
                <input name="cari" type="text" placeholder="Cari nis/nik, nama...."
                    class="bg-white w-full pl-12 pr-4 py-3 rounded-md placeholder:text-gray-300 border border-gray-200"
                    value="{{ request('cari') }}">
            </div>
            <button type="submit"
                class="bg-[#35094D] text-white px-6 py-3 rounded-md hover:bg-[#2a073a] transition duration-300 cursor-pointer">Cari</button>
        </form>
    </section>

    <section class="">
        <div class="bg-white w-full rounded-xl mt-4 p-6">
            <div class="mb-10">
                <h2 class="text-2xl text-gray-500 font-medium">Daftar pengembalian - Pending</h2>
                <p class="text-sm text-gray-400">Konfirmasi pengembalian dan hitung total denda jika ada.</p>
            </div>
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-gray-200">
                        <th class="pb-4 text-center text-gray-400 font-normal">Kode Buku</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Nik/Nis</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tgl Pinjam</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tgl Tempo</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tgl Pengembalian</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Detail</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Status Pengembalian</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[#35094D]">
                    @forelse ($pengembalians as $pengembalian)
                        @php
                            $isTerlambat = \Carbon\Carbon::parse($pengembalian->tanggal_kembalian)->gt(
                                \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal_jatuh_tempo),
                            );
                        @endphp
                        <tr class="border-b border-gray-200">
                            <td class="py-4 text-center">{{ $pengembalian->peminjaman->buku->kode_buku ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $pengembalian->peminjaman->anggota->nomer_induk ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $pengembalian->peminjaman->tanggal_pinjam ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $pengembalian->peminjaman->tanggal_jatuh_tempo ?? 'N/A' }}</td>
                            @if ($isTerlambat)
                                <td class="py-4 text-center text-red-500 font-medium">Terlambat -
                                    {{ $pengembalian->tanggal_kembalikan ?? 'N/A' }}</td>
                            @else
                                <td class="py-4 text-center">
                                    {{ $pengembalian->tanggal_kembalikan ?? 'N/A' }}</td>
                            @endif
                            <td class="py-4 flex justify-center">
                                <button class="openModalDetailpengembalian" type="button"
                                    class="flex justify-center cursor-pointer">
                                    <img src="{{ asset('icons/svg/detail.svg') }}" alt="">
                                </button>
                            </td>
                            <td class="py-4 text-center">
                                <span class="bg-[#F99D22] text-white px-6 py-2 rounded-full">
                                    {{ $pengembalian->status ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="py-4 text-center">
                                @if ($isTerlambat)
                                    <button class="bg-red-500 cursor-pointer text-white px-6 py-2 rounded-full">
                                        Hitung Denda
                                    </button>
                                @else
                                    <button type="button" data-id="{{ $pengembalian->id }}" class="openModalPengembalian bg-[#35094D] cursor-pointer text-white px-6 py-2 rounded-full">
                                        Konfirmasi
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-gray-500">Tidak ada Data yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-5">
                {{ $pengembalians->links() }}
            </div>
        </div>
    </section>

    {{-- Modal Pengembalian --}}
    <section
        class="open_modal_pengembalian hidden fixed inset-0 bg-[#0F172A]/60 backdrop-blur-md flex justify-center items-center z-50 p-4 transition-all">
        <div class="bg-white w-full max-w-md rounded-3xl  overflow-hidden transform transition-all scale-100">
            <div class="p-8 text-center">
                <div class="w-20 h-20 bg-[#35094D]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <img class="w-12" src="{{ asset('icons/svg/ajukan-jadwal.svg') }}" alt="">
                </div>
                <h2 class="text-[#35094D] text-2xl font-bold">Konfirmasi Pengembalian?</h2>
                <p class="text-gray-500 mb-8">silahkan konfirmasi pengembalian</p>

                <div class="flex flex-col gap-3">
                    <form class="all_form form_pengenbalian" action="" method="POST">
                        @csrf
                        <input type="hidden" name="" value="">
                        <button type="submit"
                            class="btn_simpan_perubahan w-full bg-[#35094D] text-white font-bold py-4 rounded-xl transition-all flex items-center justify-center gap-2">
                            <svg id="" class="spinner_load hidden animate-spin h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span class="text_simpan">Ya, Konfirmasi</span>
                        </button>
                    </form>
                    <button
                        class="btn_close_pengembalian w-full border-2 border-gray-100 text-gray-400 font-bold py-4 rounded-xl hover:bg-gray-50 transition-all">
                        Batalkan
                    </button>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Modal Pengembalian
        const openModalPengembalian = document.querySelectorAll('.openModalPengembalian');
        const modalPengembalian = document.querySelector('.open_modal_pengembalian');
        const formPengembalian = document.querySelector('.form_pengenbalian');
        const closeModalPengembalian = document.querySelector('.btn_close_pengembalian');

        openModalPengembalian.forEach(btn => {
            btn.addEventListener("click", function() {
                const id = this.dataset.id;
                modalPengembalian.classList.remove('hidden');
                formPengembalian.action = `/pengembalian/${id}`;
            });
        });

        closeModalPengembalian.addEventListener("click", function() {
            modalPengembalian.classList.add('hidden');
        });

    </script>

@endsection
