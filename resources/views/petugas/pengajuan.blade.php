@extends('layouts.index')

@section('halaman', 'Daftar Pengajuan')

@section('main')


    {{-- Filter --}}
    {{-- <section class="mt-20 mb-8 flex justify-end">
        <div>
            <input type="date" class="bg-white px-10 text-gray-400 py-2 rounded-4xl">
        </div>
    </section> --}}

    <section class="mt-20">
        <div class="bg-white w-full rounded-xl mt-4 p-6">
            <div class="mb-10">
                <h2 class="text-2xl text-gray-500 font-medium">Daftar Pengajuan - Pending</h2>
                <p class="text-sm text-gray-400">Konfirmasi pengajuan ataupun tolak pengajuan.</p>
            </div>
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-gray-200">
                        <th class="pb-4 text-center text-gray-400 font-normal">Kode Buku</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Judul Buku</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Nik/Nis</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Nama Peminjam</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tanggal Pinjam</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Detail</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Status</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[#35094D]">
                    @forelse ($pengajuans as $pengajuan)
                        <tr class="border-b border-gray-200">
                            <td class="py-4 text-center">{{ $pengajuan->buku->kode_buku ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $pengajuan->buku->judul_buku ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $pengajuan->anggota->nomer_induk ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $pengajuan->anggota->nama_lengkap ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $pengajuan->tanggal_pinjam ?? 'N/A' }}</td>
                            <td class="py-4">
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
                            </td>
                            <td class="py-4 text-center">
                                <span class="bg-[#F99D22] text-white px-6 py-2 rounded-full">
                                    {{ $pengajuan->status ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="py-4 text-center">
                                <button data-id="{{ $pengajuan->id }}" data-buku="{{ $pengajuan->buku->judul_buku }}"
                                    data-tgl_pinjam="{{ $pengajuan->tanggal_pinjam }}"
                                    class="btn_open_modal_tolak_ajukan border border-gray-300 cursor-pointer text-[#35094D] px-6 py-2 rounded-full">
                                    Tolak
                                </button>
                                <button data-id="{{ $pengajuan->id }}"
                                    class="btn_open_modal_konir_ajukan bg-[#35094D] cursor-pointer text-white px-6 py-2 rounded-full">
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
                {{ $pengajuans->links() }}
            </div>
        </div>
    </section>

    <section class="mt-20">
        {{-- Header --}}
        <div class="flex flex-col gap-4 mb-6">

            <div class="flex flex-col md:flex-row md:items-center justify-end gap-3">
                <form action="/pengajuan" method="GET" class="form-cari flex gap-2 items-center">
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
                <a href="#" id="btnExport"
                    class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-all shadow-sm">
                    <img src="{{ asset('icons/svg/pdf-export.svg') }}" alt="">
                    <span class="font-medium">Export PDF</span>
                </a>

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

    {{-- Modal Konfirmasi Pinjaman --}}
    <section id="open_modal_konfir_ajukan"
        class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex justify-center items-center z-50 transition-opacity duration-300">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl transform transition-all overflow-hidden">
            <div class="bg-slate-50 p-8 flex flex-col items-center border-b border-gray-100">
                <h3 class="text-[#35094D] text-xl font-bold">Konfirmasi Pinjaman</h3>
                <p class="text-gray-500 text-sm text-center mt-1">Pastikan data peminjam dan buku sudah sesuai sebelum
                    menyetujui.</p>
            </div>

            {{-- Form Body --}}
            <form id="form_konfir_ajukanKonfirmasi" action="" method="POST" class="all_form p-8">
                @csrf
                <div class="mb-8">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2"
                        for="jatuh_tempo">
                        Atur Tanggal Jatuh Tempo <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="date" name="tanggal_jatuh_tempo" id="jatuh_tempo" required
                            class="w-full border border-gray-200 focus:border-[#35094D] focus:ring-2 focus:ring-[#35094D]/20 outline-none px-4 py-3 rounded-xl text-gray-700 transition-all appearance-none">
                    </div>
                    <p class="mt-2 text-[11px] text-gray-400 font-italic italic">*Batas waktu pengembalian buku oleh
                        anggota.</p>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-center gap-3">
                    <button type="button"
                        class="btn_close_konfir_ajukan border border-gray-300 text-gray-600 font-medium px-6 py-3 rounded-xl cursor-pointer">
                        Nanti Saja
                    </button>
                    <button id="" type="submit"
                        class="btn_simpan_perubahan bg-[#35094D] text-white font-medium px-6 py-3 rounded-xl cursor-pointer flex items-center gap-2">
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
                </div>
            </form>
        </div>
    </section>

    {{-- Modal Tolak Pengajuan --}}
    <section id="modalTolak"
        class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex justify-center items-center z-50 transition-opacity duration-300">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl transform transition-all overflow-hidden">
            <div class="bg-slate-50 p-8 flex flex-col items-center border-b border-gray-100 text-center">
                <h3 class="text-[#35094D] text-xl font-bold">Konfirmasi Penolakan</h3>
                <p class="text-gray-500 text-sm mt-1">Berikan alasan yang jelas agar peminjam dapat memahami keputusan ini.
                </p>
            </div>

            <form id="formTolak" action="" method="POST" class="all_form p-8">
                @csrf

                <div class="mb-6">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">
                        Pilih Template Alasan
                    </label>
                    <div class="flex flex-wrap gap-2">
                        <button type="button" onclick="setTemplate('stok')"
                            class="border border-gray-200 text-[11px] font-medium px-3 py-1.5 rounded-lg text-gray-600 hover:border-red-400 hover:text-red-500 hover:bg-red-50 transition-colors">
                            Stok Habis
                        </button>
                        <button type="button" onclick="setTemplate('batas')"
                            class="border border-gray-200 text-[11px] font-medium px-3 py-1.5 rounded-lg text-gray-600 hover:border-red-400 hover:text-red-500 hover:bg-red-50 transition-colors">
                            Batas Pinjam
                        </button>
                        <button type="button" onclick="setTemplate('data')"
                            class="border border-gray-200 text-[11px] font-medium px-3 py-1.5 rounded-lg text-gray-600 hover:border-red-400 hover:text-red-500 hover:bg-red-50 transition-colors">
                            Data Anggota
                        </button>
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2"
                        for="alasanTolak">
                        Rincian Alasan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="alasanTolak" name="alasan" rows="4" required
                        class="w-full border border-gray-200 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 outline-none px-4 py-3 rounded-xl text-gray-700 transition-all resize-none placeholder:text-gray-300 text-sm"
                        placeholder="Contoh: Maaf, stok buku ini habis..."></textarea>
                </div>

                <div class="flex items-center justify-center gap-3">
                    <button type="button"
                        class="close_modal_tolak_ajukan border border-gray-300 text-gray-600 font-medium px-6 py-3 rounded-xl cursor-pointer hover:bg-gray-50 transition-colors flex-1 text-center">
                        Batalkan
                    </button>
                    <button id="" type="submit"
                        class="btn_simpan_perubahan bg-[#35094D] flex-1 text-white font-medium px-6 py-3 rounded-xl cursor-pointer flex items-center gap-2 justify-center">
                        <svg id="" class="spinner_load hidden animate-spin h-5 w-5 text-white"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        <span class="text_simpan">Ya, Tolak</span>
                    </button>
                </div>
            </form>
        </div>
    </section>

    {{-- Modal Detail --}}
    <section
        class="modal_detail_pengajuan hidden fixed inset-0 bg-gray-900/50 backdrop-blur-sm flex items-center justify-center p-4 z-50">
        <div
            class="bg-white w-full max-w-4xl rounded-2xl shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">

            <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-purple-50/50">
                <h2 class="text-2xl font-bold text-[#35094D]">Detail Pengajuan</h2>
                <button class="closeModalPengajuan text-gray-400 hover:text-red-500 cursor-pointer">
                    Close
                </button>
            </div>

            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">

                <div class="space-y-6">
                    <div class="mb-4">
                        <h3 class="font-semibold text-gray-400 uppercase tracking-wider text-sm">Informasi Anggota</h3>
                    </div>

                    <div class="grid gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">NIS / NIK</label>
                            <input type="text" readonly value=""
                                class="nomer_induk w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 text-gray-700 focus:ring-2 focus:ring-purple-500 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Anggota</label>
                            <input type="text" readonly value=""
                                class="nama_lengkap w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 text-gray-700 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Jenis Kelamin</label>
                            <input type="text" readonly value=""
                                class="jenis_kelamin w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 text-gray-700 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Alamat</label>
                            <textarea readonly
                                class="alamat w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 text-gray-700 outline-none h-24 resize-none">-</textarea>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="mb-2">
                        <h3 class="font-semibold text-gray-400 uppercase tracking-wider text-sm">Detail Pengajuan</h3>
                    </div>

                    <div class="bg-gray-50 p-5 rounded-xl border border-gray-100 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-[#35094D] uppercase mb-1">Tanggal
                                    Pinjam</label>
                                <div class="relative">
                                    <input type="text" readonly value=""
                                        class="tgl_pinjam w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700">
                                </div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-red-600 uppercase mb-1">Jatuh Tempo</label>
                                <input type="text" readonly value=""
                                    class="tgl_tempo w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700 font-semibold">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Status</label>
                            <span class="status inline-flex items-center px-3 py-1 rounded-full text-xs font-medium">
                                -
                            </span>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="grid grid-cols-3 gap-4">
                            <div class="col-span-1">
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Kode</label>
                                <input type="text" readonly value=""
                                    class="kode_buku w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Judul Buku</label>
                                <input type="text" readonly value=""
                                    class="judul_buku w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700 font-bold">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Penulis</label>
                                <input type="text" readonly value=""
                                    class="penulis w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tahun Terbit</label>
                                <input type="text" readonly value=""
                                    class="thn_terbit w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Script Konfirmasi Peminjaman Buku
            const modal_konfir_ajukan = document.getElementById('open_modal_konfir_ajukan');
            const form_konfir_ajukan = document.getElementById('form_konfir_ajukanKonfirmasi');
            const openButtons = document.querySelectorAll('.btn_open_modal_konir_ajukan');
            const closeButtons = document.querySelectorAll('.btn_close_konfir_ajukan');

            // Fungsi Membuka Modal
            openButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    form_konfir_ajukan.action = `/pengajuan/konfirmasi/${id}`;

                    // Munculkan modal
                    modal_konfir_ajukan.classList.remove('hidden');
                    modal_konfir_ajukan.classList.add('flex');
                });
            });

            // Fungsi Menutup Modal
            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    modal_konfir_ajukan.classList.add('hidden');
                    modal_konfir_ajukan.classList.remove('flex');
                });
            });
            //  END Script Konfirmasi Peminjaman Buku


            // Script Tolak Ajukan Buku
            const modal = document.getElementById('modalTolak');
            const textarea = document.getElementById('alasanTolak');
            const form = document.getElementById('formTolak');
            const openModalTolakAjukan = document.querySelectorAll('.btn_open_modal_tolak_ajukan');
            const templateButtons = document.querySelectorAll('.btn-template');

            let currentBuku = '';
            let currentTanggal = '';

            openModalTolakAjukan.forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;

                    currentBuku = this.dataset.buku;
                    currentTanggal = this.dataset.tgl_pinjam;

                    form.action = `/pengajuan/tolak/${id}`;

                    modal.classList.remove('hidden');

                    // reset textarea
                    textarea.value = '';
                    templateButtons.forEach(b => b.classList.remove('active'));
                });
            });

            document.querySelectorAll('.close_modal_tolak_ajukan').forEach(btn => {
                btn.addEventListener('click', function() {
                    modal.classList.add('hidden');
                });
            });

            window.setTemplate = function(type, el) {

                let template = '';

                if (type === 'stok') {
                    template =
                        `Permintaan peminjaman buku tidak dapat disetujui karena stok buku sedang tidak tersedia.

            Rincian:
            - Judul buku       : ${currentBuku}
            - Status stok      : Tidak tersedia
            - Tanggal pengajuan: ${currentTanggal}`;
                }

                if (type === 'batas') {
                    template =
                        `Permintaan peminjaman tidak dapat diproses karena batas maksimal peminjaman telah tercapai.

            Rincian:
            - Judul buku       : ${currentBuku}
            - Status           : Melebihi batas peminjaman
            - Tanggal pengajuan: ${currentTanggal}`;
                }

                if (type === 'data') {
                    template =
                        `Permintaan peminjaman ditolak karena data anggota tidak valid atau belum lengkap.

            Rincian:
            - Judul buku       : ${currentBuku}
            - Status           : Data tidak valid
            - Tanggal pengajuan: ${currentTanggal}`;
                }

                textarea.value = template;
            };

            // Modal Detail Pengajuan
            const openModalDetailPengajuan = document.querySelectorAll('.openModalDetailPengajuan');
            const modalDetailPengajuan = document.querySelector('.modal_detail_pengajuan');
            const closeModalPengajuan = document.querySelector('.closeModalPengajuan');
            const InputNomerInduk = document.querySelector('.nomer_induk');
            const InputNama = document.querySelector('.nama_lengkap');
            const InputJk = document.querySelector('.jenis_kelamin');
            const InputAlamat = document.querySelector('.alamat');

            const InputTgl_pinjam = document.querySelector('.tgl_pinjam');
            const InputTgl_tempo = document.querySelector('.tgl_tempo');
            const InputStatus = document.querySelector('.status');

            const InputKode_buku = document.querySelector('.kode_buku');
            const InputJudul_buku = document.querySelector('.judul_buku');
            const InputPenulis = document.querySelector('.penulis');
            const InputThn_terbit = document.querySelector('.thn_terbit');

            openModalDetailPengajuan.forEach(btn => {
                btn.addEventListener("click", function() {
                    const id = this.dataset.id;

                    const no_induk = this.dataset.nomer_induk;
                    const nama_lengkap = this.dataset.nama;
                    const jk = this.dataset.jk;
                    const alamat = this.dataset.alamat;

                    const tgl_pinjam = this.dataset.tgl_pinjam;
                    const tgl_tempo = this.dataset.tgl_tempo;

                    const status = this.dataset.status;
                    const kode_buku = this.dataset.kode_buku;
                    const judul_buku = this.dataset.judul_buku;
                    const penulis = this.dataset.penulis;
                    const thn_terbit = this.dataset.thn_terbit;


                    modalDetailPengajuan.classList.remove("hidden");

                    InputNomerInduk.value = no_induk ?? 'N/A';
                    InputNama.value = nama_lengkap ?? 'N/A';
                    InputJk.value = jk ?? 'N/A';
                    InputAlamat.value = alamat ?? 'Tidak Ada Alamat';
                    InputTgl_pinjam.value = tgl_pinjam;
                    InputTgl_tempo.value = tgl_tempo ?? '-';

                    if (status === "dipinjamkan") {
                        InputStatus.classList.add('bg-green-200', 'text-green-500');
                        InputStatus.innerHTML = status;
                    } else if (status === "ditolak") {
                        InputStatus.classList.add('bg-red-200', 'text-red-500');
                        InputStatus.innerHTML = status;
                    } else {
                        InputStatus.classList.add('bg-yellow-200', 'text-yellow-500');
                        InputStatus.innerHTML = status;
                    }

                    InputKode_buku.value = kode_buku;
                    InputJudul_buku.value = judul_buku;
                    InputPenulis.value = penulis;
                    InputThn_terbit.value = thn_terbit;
                })
            });

            closeModalPengajuan.addEventListener("click",function() {
                modalDetailPengajuan.classList.add('hidden');
            });

        });
    </script>
@endsection
