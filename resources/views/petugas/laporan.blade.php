@extends('layouts.index')

@section('halaman', 'Kelola Laporan')

@section('main')


    {{-- Filter  --}}
    <section class="mt-20 flex justify-end gap-5">
        {{-- Searching  --}}
        <form action="/laporan" method="GET" class="form-cari flex items-center gap-2">
            <div class="relative w-full max-w-[450px]">
                <input name="cari" type="date"
                    class="bg-white w-full px-2 py-3 rounded-md text-gray-300 border border-gray-200"
                    value="{{ request('cari') }}">
            </div>
            <button type="submit"
                class="bg-[#35094D] text-white px-6 py-3 rounded-md hover:bg-[#2a073a] transition duration-300 cursor-pointer">Cari</button>
        </form>
        <button type="button" id="openUploadLaporan"
            class="flex items-center gap-2 bg-blue-400 rounded-lg text-white font-semibold cursor-pointer px-6 py-2">
            <img src="{{ asset('icons/svg/pdf-export.svg') }}" alt="">
            <span>Upload File</span>
        </button>
    </section>

    <section class="">
        <div class="bg-white w-full rounded-xl mt-4 p-6">
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-gray-200">
                        <th class="pb-4 text-center text-gray-400 font-normal">Tipe Laporan</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Nama Petugas</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Preview</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tanggal Upload</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Status</th>
                    </tr>
                </thead>
                <tbody class="text-[#35094D]">
                    @forelse ($laporans as $laporan)
                        <tr class="border-b border-gray-200">
                            <td class="py-4 text-center">{{ $laporan->tipe_laporan ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $laporan->petugas->nama_lengkap ?? 'N/A' }}</td>
                            <td class="py-4 text-center">
                                <a href="{{ asset('storage/' . $laporan->file) }}" target="_blank"
                                    class="text-blue-500 hover:underline">
                                    Lihat Preview
                                </a>
                            </td>
                            <td class="py-4 text-center">{{ $laporan->created_at->format('d-m-Y') ?? 'N/A' }}</td>
                            <td class="py-4 text-center">
                                <span class="bg-[#F99D22] text-white px-6 py-2 rounded-full">
                                    {{ $laporan->status ?? 'N/A' }}
                                </span>
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
        </div>
    </section>

    {{-- Modal Upload File --}}
    <section class="modal_upload_laporan hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" onclick="toggleModal()"></div>

        <div
            class="relative bg-white w-full max-w-md rounded-[1.5rem] shadow-xl overflow-hidden transform transition-all scale-100 ring-1 ring-black/5">
            <div class="p-6">
                <div class="text-center mb-6">
                    <div class="flex justify-center">
                        <img class="w-10" src="{{ asset('icons/svg/upload.svg') }}" alt="">
                    </div>
                    <h2 class="text-[#35094D] text-xl font-bold">Upload Laporan</h2>
                    <p class="text-slate-400 text-xs mt-1">Format file harus berupa PDF.</p>
                </div>

                <form action="/laporan" method="POST" enctype="multipart/form-data" class="all_form space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-semibold text-[#35094D] mb-1.5 px-1 uppercase tracking-wider">Tipe
                            Laporan</label>
                        <select name="tipe_laporan" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-lg px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-[#35094D]/10 focus:border-[#35094D] transition-all cursor-pointer">
                            <option value="" disabled selected>Pilih tipe laporan</option>
                            <option value="Konfirmasi Pengajuan">Laporan Konfirmasi Pengajuan</option>
                            <option value="Konfirmasi Pengembalian">Laporan Konfirmasi Pengembalian</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-[#35094D] mb-1.5 px-1 uppercase tracking-wider">File
                            (PDF)</label>
                        <label for="file_upload"
                            class="group relative flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-slate-200 rounded-xl hover:border-blue-400 hover:bg-blue-50/50 transition-all cursor-pointer">
                            <div class="flex flex-col items-center justify-center">
                                <p class="text-[11px] text-slate-400 group-hover:text-blue-500 transition-colors"
                                    id="file_name_display">
                                    Klik untuk pilih file
                                </p>
                            </div>
                            <input id="file_upload" name="file" type="file" class="hidden" />
                        </label>
                    </div>

                    <div class="flex flex-col gap-2 pt-2">
                        <button id="" type="submit"
                            class="btn_simpan_perubahan bg-[#35094D] text-white py-2 px-10 cursor-pointer rounded mt-5 flex items-center justify-center gap-2">
                            <svg id="" class="spinner_load hidden animate-spin h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span class="text_simpan">upload laporan</span>
                        </button>
                        <button type="button"
                            class="closeModalUpload w-full text-slate-400 text-xs font-semibold py-1 hover:text-red-400 transition-colors">
                            Batalkan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        const openUploadLaporan = document.getElementById('openUploadLaporan');
        const modalUploadLaporan = document.querySelector('.modal_upload_laporan');
        const closeModalUpload = document.querySelector('.closeModalUpload');
        const fileName = document.getElementById('file_upload');
        const fileNameDisplay = document.getElementById('file_name_display');

        openUploadLaporan.addEventListener('click', () => {
            modalUploadLaporan.classList.remove('hidden');
        });

        fileName.addEventListener('change', () => {
            if (fileName.files.length > 0) {
                fileNameDisplay.textContent = fileName.files[0].name;
                fileNameDisplay.classList.add('font-bold');
            } else {
                fileNameDisplay.textContent = 'Klik untuk pilih file';
                fileNameDisplay.classList.remove('font-bold');
            }
        });

        closeModalUpload.addEventListener('click', () => {
            modalUploadLaporan.classList.add('hidden');
        });
    </script>
@endsection
