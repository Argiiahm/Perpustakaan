@extends('layouts.index')

@section('halaman', 'Daftar Pengajuan')

@section('main')


    {{-- Filter --}}
    <section class="mt-20 flex justify-end">
        {{-- Searching --}}
        <form action="/pengajuan" method="GET" class="form-cari flex items-center gap-2">
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
    @include('components.modal-detail-pengajuan')

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
        });
    </script>
@endsection
