@extends('layouts.index')

@section('halaman', 'Dashboard')
@section('suffix', 'Anda!')

@section('main')


    {{-- Informasi --}}
    <section class="grid grid-cols-4 gap-6 my-16">
        {{-- Jumlah Pinjaman saat ini --}}
        <div class="bg-[#35094D] p-6 rounded-[32px]">
            <div class="flex flex-col gap-4">
                <span class="text-[20px] text-[#FFFFFF]">Jumlah Pinjaman <br> Saat Ini</span>
                <span class="text-5xl text-[#FFFFFF]">2</span>
                <span class="text-[#FFFFFF90] text-[10px]">
                    *setiap kamu pinjam angka pinjaman akan <br> bertambah
                </span>
            </div>
        </div>
        {{-- Jumlah Kembalikan Buku --}}
        <div class="bg-[#F99D22] p-6 rounded-[32px]">
            <div class="flex flex-col gap-4">
                <span class="text-[20px] text-[#FFFFFF]">Jumlah Kembalikan <br> Buku</span>
                <span class="text-5xl text-[#FFFFFF]">18</span>
                <span class="text-[#FFFFFF90] text-[10px]">
                    *setiap kamu kembalikan Buku seluruh <br> pengembalian bukumu akan tercatat disini
                </span>
            </div>
        </div>
        {{-- Kelengkapan Profile --}}
        <div class="bg-[#0B4B88] p-6 rounded-[32px]">
            <div class="flex flex-col gap-4">
                <span class="text-[20px] text-[#FFFFFF]">Kelengkapan Profile <br> Anda</span>
                <span class="text-5xl text-[#FFFFFF]">{{ $Presentase }}%</span>
                <span class="text-[#FFFFFF90] text-[10px]">
                    *Lengkapi Profile Anda Agar Petugas Bisa Cepat
                    Konfirmasi Peminjaman Anda!
                </span>
            </div>
        </div>
    </section>

    {{-- Table Dashboard - PINJAMAN AKTIF --}}
    <section>
        {{-- Label --}}
        <span class="text-[20px] font-medium text-[#35094D]">
            Pinjaman Aktif
        </span>

        <div class="bg-white w-full rounded-xl mt-4 p-6">
            {{-- Table Dshborad --}}
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-gray-200">
                        <th class="pb-4 text-gray-400 font-normal">Judul Buku</th>
                        <th class="pb-4 text-gray-400 font-normal">Tanggal Pinjam</th>
                        <th class="pb-4 text-gray-400 font-normal">Tanggal Jatuh Tempo</th>
                        <th class="pb-4 text-gray-400 font-normal">Tersisa</th>
                    </tr>
                </thead>
                <tbody class="text-[#35094D]">
                    @forelse ($Pinjaman_aktif as $pinjaman)
                        <tr class="border-b border-gray-200">
                            <td class="py-4">{{ $pinjaman->buku->judul_buku ?? 'N/A' }}</td>
                            <td class="py-4">{{ $pinjaman->tanggal_pinjam ?? 'N/A' }}</td>
                            <td class="py-4">{{ $pinjaman->tanggal_jatuh_tempo ?? 'N/A' }}</td>
                            <td class="py-4">
                                @if ($pinjaman->sisa_hari !== null)
                                    @if ($pinjaman->sisa_hari > 0)
                                        {{ $pinjaman->sisa_hari }} hari lagi
                                    @elseif ($pinjaman->sisa_hari == 0)
                                        Hari ini
                                    @else
                                        Terlambat {{ abs($pinjaman->sisa_hari) }} hari
                                    @endif
                                @else
                                    -
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

            {{-- Keterangan --}}
            <p class="text-red-500 font-medium text-sm mt-6">
                *Diingatkan kembali agar mengembalikan buku tepat waktu.
                Jika pengembalian terlambat maka ada denda yang harus dibayar sesuai ketentuan berlaku. Terima kasih.
            </p>
        </div>
    </section>

@endsection
