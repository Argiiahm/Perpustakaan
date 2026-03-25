@extends('layouts.index')

@section('halaman', 'Aktivitas Anda')

@section('main')
    <section class="mt-20">
        {{-- Header --}}
        <div class="flex flex-col gap-4 mb-6">
            <div class="flex flex-col md:flex-row md:items-center justify-end gap-3">
                <form action="/aktivitas" method="GET" class="form-cari flex gap-2 items-center">
                    <select name="filter_waktu"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="" {{ request('filter_waktu') == '' ? 'selected' : '' }}>Semua</option>
                        <option value="minggu_ini" {{ request('filter_waktu') == 'minggu_ini' ? 'selected' : '' }}>
                            Minggu Ini
                        </option>
                        <option value="bulan_ini" {{ request('filter_waktu') == 'bulan_ini' ? 'selected' : '' }}>
                            Bulan Ini
                        </option>
                        <option value="bulan_lalu" {{ request('filter_waktu') == 'bulan_lalu' ? 'selected' : '' }}>
                            Bulan Lalu
                        </option>
                    </select>

                    <button type="submit"
                        class="flex items-center gap-2 bg-[#35094D] text-white px-4 py-2 rounded-lg text-sm cursor-pointer">
                        <img class="w-5" src="{{ asset('icons/svg/filter.svg') }}" alt="">
                        <span>Terapkan</span>
                    </button>
                </form>
                {{-- Filter Preset --}}

                {{-- Tombol Export PDF --}}
                <form action="/cetak-pdf/pengajuan" method="GET" class="form-cari">
                    <input type="hidden" name="filter_waktu" value="{{ request('filter_waktu') }}">

                    <button type="submit"
                        class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-all shadow-sm">
                        <img src="{{ asset('icons/svg/pdf-export.svg') }}" alt="">
                        <span class="font-medium">Export PDF</span>
                    </button>
                </form>

            </div>
        </div>

        <div class="bg-white w-full rounded-xl mt-4 p-6">
            <div class="mb-8 flex flex-col">
                <div class="mb-3">
                    <h2 class="text-2xl text-gray-500 font-medium">Daftar Konfirmasi Pengajuan</h2>
                    <p class="text-sm text-gray-400">Kelola dan pantau riwayat peminjaman yang telah diproses.</p>
                </div>
                <div class="font-bold text-gray-500">Nama: <span
                        class="font-medium">{{ Auth::user()->Petugas->nama_lengkap ?? Auth::user()->username }}<span></div>
                <div class="font-bold text-gray-500">IDP: <span class="font-medium">
                        Petugas#{{ Auth::user()->Petugas->id ?? 'N/A' }}<span></div>
            </div>
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-gray-200">
                        <th class="pb-4 text-center text-gray-400 font-normal">Kode Buku</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Judul Buku</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Nik/Nis</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Nama Peminjam</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tanggal Pinjam</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tanggal Jatuh Tempo</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Detail</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Status</th>
                    </tr>
                </thead>
                <tbody class="text-[#35094D]">
                    @forelse ($pengajuans_konfirmasi as $pengajuan)
                        <tr class="border-b border-gray-200">
                            <td class="py-4 text-center">{{ $pengajuan->peminjaman->buku->kode_buku ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $pengajuan->peminjaman->buku->judul_buku ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $pengajuan->peminjaman->anggota->nomer_induk ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $pengajuan->peminjaman->anggota->nama_lengkap ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $pengajuan->peminjaman->tanggal_pinjam ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $pengajuan->peminjaman->tanggal_jatuh_tempo ?? 'N/A' }}</td>
                            <td class="py-4">
                                <button class="openModalDetailPengajuan" data-id="{{ $pengajuan->id }}"
                                    data-nomer_induk="{{ $pengajuan->peminjaman->anggota->nomer_induk }}"
                                    data-nama="{{ $pengajuan->peminjaman->anggota->nama_lengkap }}"
                                    data-jk="{{ $pengajuan->peminjaman->anggota->jenis_kelamin }}"
                                    data-alamat="{{ $pengajuan->peminjaman->anggota->alamat }}"
                                    data-tgl_pinjam="{{ $pengajuan->peminjaman->tanggal_pinjam }}"
                                    data-tgl_tempo="{{ $pengajuan->peminjaman->tanggal_jatuh_tempo }}"
                                    data-status="{{ $pengajuan->status }}"
                                    data-kode_buku="{{ $pengajuan->peminjaman->buku->kode_buku }}"
                                    data-judul_buku="{{ $pengajuan->peminjaman->buku->judul_buku }}"
                                    data-penulis="{{ $pengajuan->peminjaman->buku->penulis }}"
                                    data-thn_terbit="{{ $pengajuan->peminjaman->buku->tahun_terbit }}" type="button"
                                    class="flex justify-center cursor-pointer">
                                    <img src="{{ asset('icons/svg/detail.svg') }}" alt="">
                                </button>
                            </td>
                            <td class="py-4 text-center capitalize">
                                @if ($pengajuan->status === 'dipinjamkan')
                                    <span class="bg-[#16C09861] font-medium text-[#008767] px-6 py-2 rounded-full">
                                        {{ $pengajuan->status }}
                                    </span>
                                @elseif ($pengajuan->status === 'ditolak')
                                    <span class="bg-red-200 font-medium text-red-500 px-6 py-2 rounded-full">
                                        {{ $pengajuan->status }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-gray-500">Tidak ada data yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{-- Modal Detail --}}
    @include('components.modal-detail-pengajuan')


@endsection
