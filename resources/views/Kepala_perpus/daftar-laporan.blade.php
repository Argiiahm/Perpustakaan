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
                                @if ($item->status === 'rejected')
                                    <span class="text-red-400">Ditolak</span>
                                @else
                                    <a href="{{ asset('storage/' . $item->file) }}" target="_blank"
                                        class="text-blue-500 hover:underline">
                                        Lihat Preview
                                    </a>
                                @endif
                            </td>
                            <td class="py-4 text-center">
                                @if ($item->status == 'pending')
                                    <span
                                        class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-xs">Pending</span>
                                @elseif ($item->status == 'approved')
                                    <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-xs">Approved</span>
                                @elseif ($item->status == 'rejected')
                                    <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full text-xs">Rejected</span>
                                @endif
                            </td>
                            <td class="py-4 text-center">
                                @if ($item->status === 'approved' || $item->status === 'rejected')
                                    <span>Sudah dikonfirmasi.</span>
                                @else
                                    <div class="flex items-center justify-center gap-2">
                                        <button data-id="{{ $item->id }}"
                                            class="btnOpenModalReject bg-red-500 text-white px-4 py-2 rounded-lg text-sm cursor-pointer">Rejected</button>
                                        <button data-id="{{ $item->id }}"
                                            class="btnOpenModalApprove bg-green-500 text-white px-4 py-2 rounded-lg text-sm cursor-pointer">Approve</button>
                                    </div>
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

    {{-- Modal Approved Laporan --}}
    <section
        class="open_modal_approve hidden fixed inset-0 bg-[#0F172A]/60 backdrop-blur-md flex justify-center items-center z-50 p-4 transition-all">
        <div class="bg-white w-full max-w-md rounded-3xl  overflow-hidden transform transition-all scale-100">
            <div class="p-8 text-center">
                <div class="flex flex-col gap-3">
                    <form class="form_approve_laporan all_form" method="POST">
                        @csrf
                        <input type="hidden" name="" value="">
                        <button type="submit"
                            class="btn_simpan_perubahan w-full bg-[#35094D] text-white font-bold py-4 rounded-xl transition-all flex items-center justify-center gap-2">
                            <svg id="" class="spinner_load hidden animate-spin h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span class="text_simpan">Approve</span>
                        </button>
                    </form>
                    <button
                        class="btn_close_approve w-full border-2 border-gray-100 text-gray-400 font-bold py-4 rounded-xl hover:bg-gray-50 transition-all">
                        Kembali
                    </button>
                </div>
            </div>
        </div>
    </section>
    {{-- Modal Rejected Laporan --}}
    <section
        class="open_modal_reject hidden fixed inset-0 bg-[#0F172A]/60 backdrop-blur-md flex justify-center items-center z-50 p-4 transition-all">
        <div class="bg-white w-full max-w-md rounded-3xl  overflow-hidden transform transition-all scale-100">
            <div class="p-8 text-center">
                <div class="flex flex-col gap-3">
                    <form class="form_reject_laporan all_form" method="POST">
                        @csrf
                        <input type="hidden" name="" value="">
                        <button type="submit"
                            class="btn_simpan_perubahan w-full bg-red-500 text-white font-bold py-4 rounded-xl transition-all flex items-center justify-center gap-2">
                            <svg id="" class="spinner_load hidden animate-spin h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span class="text_simpan">Reject</span>
                        </button>
                    </form>
                    <button
                        class="btn_close_reject w-full border-2 border-gray-100 text-gray-400 font-bold py-4 rounded-xl hover:bg-gray-50 transition-all">
                        Kembali
                    </button>
                </div>
            </div>
        </div>
    </section>

    <script>
        // MODAL APPROVE
        // Open Modal Approve
        const btnModalOpenApprove = document.querySelectorAll('.btnOpenModalApprove');
        const modalApprove = document.querySelector('.open_modal_approve');
        const closeModalApprove = document.querySelector('.btn_close_approve');
        const formApprove = document?.querySelector('.form_approve_laporan');

        // Modal Approve
        btnModalOpenApprove.forEach(btn => {
            btn.addEventListener("click", function() {
                const id = this.dataset.id;
                modalApprove.classList.remove('hidden');
                formApprove.action = `/approve/laporan/${id}`;
            });
        });

        // Close Modal Approve
        closeModalApprove.addEventListener("click", function() {
            modalApprove.classList.add('hidden');
        });
        // END MODAL APPROVE     

        // MODAL REJECTED
        const btnModalOpenReject = document.querySelectorAll('.btnOpenModalReject');
        const modalReject = document.querySelector('.open_modal_reject');
        const closeModalReject = document.querySelector('.btn_close_reject');
        const formReject = document?.querySelector('.form_reject_laporan');

        // Modal Rejected
        btnModalOpenReject.forEach(btn => {
            btn.addEventListener("click", function() {
                const id = this.dataset.id;
                modalReject.classList.remove('hidden');
                formReject.action = `/reject/laporan/${id}`;
            });
        });

        // Close Modal Rejected
        closeModalReject.addEventListener("click", function() {
            modalReject.classList.add('hidden');
        });
        // END MODAL REJECTED
    </script>


@endsection
