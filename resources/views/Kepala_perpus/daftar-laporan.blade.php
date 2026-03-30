@extends('layouts.index')

@section('halaman', 'Daftar Laporan Petugas')

@section('main')
    <section class="mt-20">
        {{-- Header --}}
        <div class="flex flex-col gap-4 mb-6">
            <div class="flex flex-col md:flex-row md:items-center justify-end gap-3">
                <form action="/daftar-laporan" method="GET" class="form-cari flex gap-2 items-center">
                    <select name="jenis_laporan"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="Semua" {{ request('jenis_laporan', 'Semua') == 'Semua' ? 'selected' : '' }}>
                            Semua laporan
                        </option>

                        <option value="Konfirmasi Pengajuan"
                            {{ request('jenis_laporan', 'Semua') == 'Konfirmasi Pengajuan' ? 'selected' : '' }}>
                            Konfirmasi Pengajuan
                        </option>

                        <option value="Konfirmasi Pengembalian"
                            {{ request('jenis_laporan', 'Semua') == 'Konfirmasi Pengembalian' ? 'selected' : '' }}>
                            Konfirmasi Pengembalian
                        </option>
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
            </div>
        </div>

        <div class="bg-white w-full rounded-xl mt-10 p-6">
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-gray-200">
                        <th class="pb-4 text-center text-gray-400 font-normal">Nama petugas</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tipe Laporan</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Preview</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Status</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[#35094D]">
                    @forelse ($laporans as $item)
                        <tr class="border-b border-gray-200">
                            <td class="py-4 text-center">{{ $item->petugas->nama_lengkap ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $item->tipe_laporan ?? 'N/A' }}</td>
                            <td class="py-4 text-center">
                                <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                    class="text-blue-500 hover:underline">
                                    Lihat Preview
                                </a>
                            </td>
                            <td class="py-4 text-center">
                                @if ($item->status == 'pending')
                                    <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-xs">Pending</span>   
                                @elseif ($item->status == 'approved')
                                    <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-xs">Approved</span>
                                @elseif ($item->status == 'rejected')
                                    <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full text-xs">Rejected</span>
                                @endif
                            </td>
                            <td class="py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm cursor-pointer">Rejected</button>
                                    <button class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm cursor-pointer">Approve</button>
                                </div>
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


@endsection
