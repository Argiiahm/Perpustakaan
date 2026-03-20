@extends('layouts.index')

@section('halaman', 'Dashboard')
@section('suffix', 'Anda!')

@section('main')


    {{-- Informasi --}}
    <section class="grid grid-cols-4 gap-6 my-16">
        {{-- Jumlah Pinjaman saat ini --}}
        <div class="bg-[#35094D] p-6 rounded-[32px]">
            <div class="flex flex-col gap-4">
                <span class="text-[20px] text-[#FFFFFF]">Jumlah Pengajuan <br> Saat Ini</span>
                <span class="text-5xl text-[#FFFFFF]">{{ $Pengajuan }}</span>
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
                    *setiap Anggota Mengajukan Pinjaman Buku <br> Angka Akan Bertambah
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
            Pengajuan Terbaru
        </span>

        <div class="bg-white w-full rounded-xl mt-4 p-6">
            {{-- Table Dshborad --}}
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-gray-200">
                        <th class="pb-4 text-gray-400 font-normal">Judul Buku</th>
                        <th class="pb-4 text-gray-400 font-normal">Nama Anggota</th>
                        <th class="pb-4 text-gray-400 font-normal">Tanggal Pinjam</th>
                        <th class="pb-4 text-gray-400 font-normal">Ket. Pengajuan</th>
                    </tr>
                </thead>
                <tbody class="text-[#35094D]">
                    @forelse ($Pengajuan_terbaru as $pengajuan)
                        <tr class="border-b border-gray-200">
                            <td class="py-4">{{ $pengajuan->buku->judul_buku }}</td>
                            <td class="py-4">{{ $pengajuan->anggota->nama_lengkap }}</td>
                            <td class="py-4">{{ $pengajuan->tanggal_pinjam }}</td>
                            <td class="py-4">{{ $pengajuan->status }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-gray-500">Tidak ada Data yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Keterangan --}}
            <p class="text-red-500 font-medium text-sm mt-6">
                *Data Teratas atau Terbaru Akan Muncul Maksimal 3 Data....
            </p>
        </div>
    </section>

@endsection
