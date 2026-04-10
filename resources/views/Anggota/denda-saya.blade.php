@extends('layouts.index')

@section('halaman', 'Daftar Denda Saya')

@section('main')
    {{-- Denda Tertunda --}}
    <section class="mt-4">
        <div class="bg-white w-full rounded-xl mt-4 p-6">
            <div class="mb-10">
                <h2 class="text-2xl text-gray-500 font-medium">Pembayaran Denda - Tertunda</h2>
                <p class="text-sm text-gray-400">Daftar denda yang belum dibayar.</p>
            </div>
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-gray-200">
                        <th class="pb-4 text-center text-gray-400 font-normal">Kode Buku</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Judul Buku</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tgl Pengembalian</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Hari Terlambat</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Buku Rusak</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Buku Hilang</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Total Denda</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody class="text-[#35094D]">
                    @forelse ($pengembalians as $pengembalian)
                        <tr class="border-b border-gray-200">
                            <td class="py-4 text-center">{{ $pengembalian->peminjaman->buku->kode_buku ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $pengembalian->peminjaman->buku->judul_buku ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $pengembalian->tanggal_kembalikan ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ abs($pengembalian->total_hari_terlambat) ?? 'N/A' }} Hari</td>
                            <td class="py-4 text-center">{{ $pengembalian->buku_rusak ? 'Ya' : 'Tidak' }}</td>
                            <td class="py-4 text-center">{{ $pengembalian->buku_hilang ? 'Ya' : 'Tidak' }}</td>
                            <td class="py-4 text-center">Rp {{ number_format($pengembalian->jumlah_denda, 0, ',', '.') }}
                            </td>
                            <td class="py-4 text-center">
                                @if ($pengembalian->status_pembayaran == 'lunas')
                                    <span class="text-green-500 font-medium">Lunas</span>
                                @else
                                    <span class="text-red-500 font-medium">Tertunda</span>
                                @endif
                            </td>
                        @empty
                        <tr>
                            <td colspan="9" class="py-4 text-center text-gray-400">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-5">
                {{ $pengembalians->links() }}
            </div>
        </div>
    </section>

    {{-- Riwayat Denda --}}
    <section class="">
        <div class="bg-white w-full rounded-xl mt-4 p-6">
            <div class="mb-10">
                <h2 class="text-2xl text-gray-500 font-medium">Riwayat Denda - Lunas</h2>
                <p class="text-sm text-gray-400">Daftar denda yang sudah lunas.</p>
            </div>
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-gray-200">
                        <th class="pb-4 text-center text-gray-400 font-normal">Kode Buku</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Judul Buku</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tgl Pengembalian</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Hari Terlambat</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Buku Rusak</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Buku Hilang</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Total Denda</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody class="text-[#35094D]">
                    @forelse ($RiwayatsDenda as $riwayat)
                        <tr class="border-b border-gray-200">
                            <td class="py-4 text-center">{{ $riwayat->peminjaman->buku->kode_buku ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $riwayat->peminjaman->buku->judul_buku ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $riwayat->tanggal_kembalikan ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ ceil($riwayat->total_hari_terlambat) ?? 'N/A' }} Hari</td>
                            <td class="py-4 text-center">{{ $riwayat->buku_rusak ? 'Ya' : 'Tidak' }}</td>
                            <td class="py-4 text-center">{{ $riwayat->buku_hilang ? 'Ya' : 'Tidak' }}</td>
                            <td class="py-4 text-center">Rp {{ number_format($riwayat->jumlah_denda, 0, ',', '.') }}
                            </td>
                            <td class="py-4 text-center">
                                @if ($riwayat->status_pembayaran == 'lunas')
                                    <span class="text-green-500 font-medium">Lunas</span>
                                @else
                                    <span class="text-red-500 font-medium">Tertunda</span>
                                @endif
                            </td>
                        @empty
                        <tr>
                            <td colspan="9" class="py-4 text-center text-gray-400">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-5">
                {{ $RiwayatsDenda->links() }}
            </div>
        </div>
    </section>
@endsection
