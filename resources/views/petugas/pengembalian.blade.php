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
                        <th class="pb-4 text-center text-gray-400 font-normal">Status</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[#35094D]">
                    @forelse ($pengembalians as $pengembalian)
                        @php
                            $isTerlambat = \Carbon\Carbon::parse($pengembalian->created_at)->gt(
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
                                    {{ $pengembalian->created_at->format('d-m-Y') ?? 'N/A' }}</td>
                            @else
                                <td class="py-4 text-center">
                                    {{ $pengembalian->created_at->format('d-m-Y') ?? 'N/A' }}</td>
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
                                    <button class="bg-[#35094D] cursor-pointer text-white px-6 py-2 rounded-full">
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
@endsection
