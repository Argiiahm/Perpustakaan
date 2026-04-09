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
                            // Cek Apakah Sudah Terlambat Atau Belum
                            $isTerlambat =
                                \Carbon\Carbon::parse($pengembalian->tanggal_kembalikan)->toDateString() >
                                \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal_jatuh_tempo)->toDateString();
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
                                <button class="openModalDetailPengembalian flex justify-center cursor-pointer"
                                    data-id="{{ $pengembalian->peminjaman->id }}"
                                    data-nomer_induk="{{ $pengembalian->peminjaman->anggota->nomer_induk }}"
                                    data-nama="{{ $pengembalian->peminjaman->anggota->nama_lengkap }}"
                                    data-jk="{{ $pengembalian->peminjaman->anggota->jenis_kelamin }}"
                                    data-alamat="{{ $pengembalian->peminjaman->anggota->alamat }}"
                                    data-tgl_pinjam="{{ $pengembalian->peminjaman->tanggal_pinjam }}"
                                    data-tgl_tempo="{{ $pengembalian->peminjaman->tanggal_jatuh_tempo }}"
                                    data-tgl_kembalikan="{{ $pengembalian->tanggal_kembalikan }}"
                                    data-total_hari_telat="{{ $pengembalian->total_hari_terlambat }}"
                                    data-status_pinjaman="{{ $pengembalian->peminjaman->status }}"
                                    data-status_kembalikan="{{ $pengembalian->status }}"
                                    data-kode_buku="{{ $pengembalian->peminjaman->buku->kode_buku }}"
                                    data-judul_buku="{{ $pengembalian->peminjaman->buku->judul_buku }}"
                                    data-penulis="{{ $pengembalian->peminjaman->buku->penulis }}"
                                    data-thn_terbit="{{ $pengembalian->peminjaman->buku->tahun_terbit }}" type="button">

                                    <img src="{{ asset('icons/svg/detail.svg') }}" alt="">
                                </button>
                            </td>
                            <td class="py-4 text-center">
                                <span class="bg-[#F99D22] text-white px-6 py-2 rounded-full">
                                    {{ $pengembalian->status ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="py-4 text-center">
                                <button type="button"
                                    class="btnOpenModalKembalikan bg-[#35094D] text-white px-6 py-2 rounded-full"
                                    data-id="{{ $pengembalian->id }}"
                                    data-judul="{{ $pengembalian->peminjaman->buku->judul_buku }}"
                                    data-kode="{{ $pengembalian->peminjaman->buku->kode_buku }}"
                                    data-nama="{{ $pengembalian->peminjaman->anggota->nama_lengkap }}"
                                    data-nis="{{ $pengembalian->peminjaman->anggota->nomer_induk }}"
                                    data-pinjam="{{ $pengembalian->peminjaman->tanggal_pinjam }}"
                                    data-tempo="{{ $pengembalian->peminjaman->tanggal_jatuh_tempo }}"
                                    data-telat="{{ $pengembalian->total_hari_terlambat }}">
                                    Konfirmasi
                                </button>
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

    {{-- Detail Pengembalian Modal --}}
    @include('components.modal-detail-pengembalian')

    {{-- Modal Kemblikan --}}
    @include('components.modal-pengembalian-konfirmasi-petugas')

@endsection
