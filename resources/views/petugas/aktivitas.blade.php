@extends('layouts.index')

@section('halaman', 'Aktivitas Anda')

@section('main')
    <section class="mt-20">
        {{-- Header --}}
        <div class="flex flex-col gap-4 mb-6">
            <div class="flex flex-col md:flex-row md:items-center justify-end gap-3">
                <form action="/aktivitas" method="GET" class="form-cari flex gap-2 items-center">
                    <select name="jenis_aktivitas"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="pengajuan"
                            {{ request('jenis_aktivitas', 'pengajuan') == 'pengajuan' ? 'selected' : '' }}>Konfirmasi
                            Pengajuan</option>
                        <option value="pengembalian" {{ request('jenis_aktivitas') == 'pengembalian' ? 'selected' : '' }}>
                            Konfirmasi Pengembalian</option>
                    </select>

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
                    <input type="hidden" name="jenis_aktivitas" value="{{ request('jenis_aktivitas') ?? 'pengajuan' }}">

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
                    <h2 class="text-2xl text-gray-500 font-medium">
                        {{ $jenis_aktivitas === 'pengembalian' ? 'Daftar Konfirmasi Pengembalian' : 'Daftar Konfirmasi Pengajuan' }}
                    </h2>
                    <p class="text-sm text-gray-400">
                        {{ $jenis_aktivitas === 'pengembalian' ? 'Kelola dan pantau riwayat pengembalian yang telah diproses.' : 'Kelola dan pantau riwayat peminjaman yang telah diproses.' }}
                    </p>
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
                        @if ($jenis_aktivitas === 'pengembalian')
                            <th class="pb-4 text-center text-gray-400 font-normal">Tanggal Dikembalikan</th>
                            <th class="pb-4 text-center text-gray-400 font-normal">Hari Telat</th>
                            <th class="pb-4 text-center text-gray-400 font-normal">Total Denda</th>
                            <th class="pb-4 text-center text-gray-400 font-normal">Status Pembayaran</th>
                        @else
                            <th class="pb-4 text-center text-gray-400 font-normal">Tanggal Pinjam</th>
                            <th class="pb-4 text-center text-gray-400 font-normal">Tanggal Jatuh Tempo</th>
                        @endif
                        <th class="pb-4 text-center text-gray-400 font-normal">Detail</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Status</th>
                    </tr>
                </thead>
                <tbody class="text-[#35094D]">
                    @forelse ($aktivitas_data as $item)
                        <tr class="border-b border-gray-200">
                            <td class="py-4 text-center">{{ $item->peminjaman->buku->kode_buku ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $item->peminjaman->buku->judul_buku ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $item->peminjaman->anggota->nomer_induk ?? 'N/A' }}</td>
                            @if ($jenis_aktivitas === 'pengembalian')
                                <td class="py-4 text-center">
                                    {{ $item->tanggal_kembalikan ?? $item->updated_at->format('Y-m-d') }}</td>
                                <td
                                    class="py-4 text-center text-{{ $item->total_hari_terlambat > 0 ? 'red-500 font-medium' : 'gray-700' }}">
                                    {{ ceil($item->total_hari_terlambat ?? 0) }} hari
                                </td>
                                <td class="py-4 text-center">Rp {{ number_format($item->jumlah_denda, 0, ',', '.') }}</td>
                                <td class="py-4 text-center">
                                    @if ($item->status_pembayaran === 'lunas')
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Lunas</span>
                                    @elseif ($item->status_pembayaran === 'tertunda')
                                        <span
                                            class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Tertunda</span>
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                            @else
                                <td class="py-4 text-center">{{ $item->peminjaman->tanggal_pinjam ?? 'N/A' }}</td>
                                <td class="py-4 text-center">{{ $item->peminjaman->tanggal_jatuh_tempo ?? 'N/A' }}</td>
                            @endif
                            <td class="py-4">
                                @if ($jenis_aktivitas === 'pengembalian')
                                    <button class="openModalDetailPengembalian mx-auto flex justify-center cursor-pointer"
                                        data-id="{{ $item->peminjaman->id }}"
                                        data-nomer_induk="{{ $item->peminjaman->anggota->nomer_induk }}"
                                        data-nama="{{ $item->peminjaman->anggota->nama_lengkap }}"
                                        data-jk="{{ $item->peminjaman->anggota->jenis_kelamin }}"
                                        data-alamat="{{ $item->peminjaman->anggota->alamat }}"
                                        data-tgl_pinjam="{{ $item->peminjaman->tanggal_pinjam }}"
                                        data-tgl_tempo="{{ $item->peminjaman->tanggal_jatuh_tempo }}"
                                        data-tgl_kembalikan="{{ $item->tanggal_kembalikan ?? $item->updated_at->format('Y-m-d') }}"
                                        data-total_hari_telat="{{ $item->total_hari_terlambat }}"
                                        data-status_pinjaman="{{ $item->peminjaman->status }}"
                                        data-status_kembalikan="{{ $item->status }}"
                                        data-kode_buku="{{ $item->peminjaman->buku->kode_buku }}"
                                        data-judul_buku="{{ $item->peminjaman->buku->judul_buku }}"
                                        data-penulis="{{ $item->peminjaman->buku->penulis }}"
                                        data-thn_terbit="{{ $item->peminjaman->buku->tahun_terbit }}"
                                        data-jumlah_denda="{{ $item->jumlah_denda }}"
                                        data-total_bayar="{{ $item->total_bayar }}"
                                        data-jumlah_bayar="{{ $item->jumlah_bayar }}"
                                        data-buku_rusak="{{ $item->buku_rusak }}"
                                        data-buku_hilang="{{ $item->buku_hilang }}"
                                        data-status_pembayaran="{{ $item->status_pembayaran }}"
                                        data-jumlah_kembalian="{{ $item->jumlah_kembalian }}" type="button">
                                        <img src="{{ asset('icons/svg/detail.svg') }}" alt="">
                                    </button>
                                @else
                                    <button class="openModalDetailPengajuan mx-auto flex justify-center cursor-pointer"
                                        data-id="{{ $item->id }}"
                                        data-nomer_induk="{{ $item->peminjaman->anggota->nomer_induk }}"
                                        data-nama="{{ $item->peminjaman->anggota->nama_lengkap }}"
                                        data-jk="{{ $item->peminjaman->anggota->jenis_kelamin }}"
                                        data-alamat="{{ $item->peminjaman->anggota->alamat }}"
                                        data-tgl_pinjam="{{ $item->peminjaman->tanggal_pinjam }}"
                                        data-tgl_tempo="{{ $item->peminjaman->tanggal_jatuh_tempo }}"
                                        data-status="{{ $item->status }}"
                                        data-kode_buku="{{ $item->peminjaman->buku->kode_buku }}"
                                        data-judul_buku="{{ $item->peminjaman->buku->judul_buku }}"
                                        data-penulis="{{ $item->peminjaman->buku->penulis }}"
                                        data-thn_terbit="{{ $item->peminjaman->buku->tahun_terbit }}" type="button">
                                        <img src="{{ asset('icons/svg/detail.svg') }}" alt="">
                                    </button>
                                @endif
                            </td>
                            <td class="py-4 text-center capitalize">
                                @if ($item->status === 'dipinjamkan' || $item->status === 'dikembalikan')
                                    <span class="bg-[#16C09861] font-medium text-[#008767] px-6 py-2 rounded-full">
                                        {{ $item->status }}
                                    </span>
                                @elseif ($item->status === 'ditolak')
                                    <span class="bg-red-200 font-medium text-red-500 px-6 py-2 rounded-full">
                                        {{ $item->status }}
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
            <div class="mt-6">
                {{ $aktivitas_data->links() }}
            </div>
        </div>
    </section>

    {{-- Modal Detail --}}
    @include('components.modal-detail-pengajuan')
    @include('components.modal-detail-pengembalian')

@endsection
