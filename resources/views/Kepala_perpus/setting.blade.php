@extends('layouts.index')

@section('halaman', 'Setting Configurasi')
@section('main')

    <div class="mt-20 px-6 py-10">
        <div class="mb-10">
            <h1 class="text-2xl font-bold text-gray-800">Pengaturan Sistem</h1>
            <p class="text-gray-500 mt-1">Kelola kebijakan peminjaman dan denda perpustakaan secara terpusat.</p>
        </div>

        <form action="/setting/{{ $setting->id }}" method="POST" class="all_form space-y-8 divide-y divide-gray-200">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2 pb-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Aturan Peminjaman</h3>
                    <p class="mt-1 text-sm text-gray-500">Tentukan batas maksimal buku yang dapat beredar di tangan anggota.
                    </p>
                </div>

                <div class="md:col-span-2 space-y-6">
                    <div class="max-w-xs">
                        <label for="max_pinjam" class="block text-sm font-medium text-gray-700 mb-2">Maksimal Buku
                            Dipinjam</label>
                        <input type="number" name="max_pinjam" id="max_pinjam"
                            value="{{ old('max_pinjam', $setting->max_pinjam) }}"
                            class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-2.5 px-4 text-gray-700 transition-all @error('max_pinjam') border-red-500 @enderror">
                        @error('max_pinjam')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="max-w-xs">
                        <label for="max_pengajuan" class="block text-sm font-medium text-gray-700 mb-2">Maksimal Pengajuan
                            (Pending)</label>
                        <input type="number" name="max_pengajuan" id="max_pengajuan"
                            value="{{ old('max_pengajuan', $setting->max_pengajuan) }}"
                            class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-2.5 px-4 text-gray-700 transition-all @error('max_pengajuan') border-red-500 @enderror">
                        @error('max_pengajuan')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="max-w-xs">
                        <label for="tanggal_jatuh_tempo" class="block text-sm font-medium text-gray-700 mb-2">Aturan Tanggal Tempo</label>
                        <input type="date" name="tanggal_jatuh_tempo" id="tanggal_jatuh_tempo"
                            value="{{ old('tanggal_jatuh_tempo', $setting->tanggal_jatuh_tempo) }}" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('+30 days')) }}"
                            class="block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 py-2.5 px-4 text-gray-700 transition-all @error('tanggal_jatuh_tempo') border-red-500 @enderror">
                        @error('tanggal_jatuh_tempo')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-8 pb-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Sanksi & Denda</h3>
                    <p class="mt-1 text-sm text-gray-500">Konfigurasi nilai nominal denda keterlambatan per satuan hari.</p>
                </div>

                <div class="md:col-span-2">
                    <div class="max-w-xs">
                        <label for="denda_per_hari" class="block text-sm font-medium text-gray-700 mb-2">Nominal Denda Per
                            Hari</label>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 text-gray-500 text-sm border-r pr-3 border-gray-200">Rp</span>
                            <input type="number" name="denda_per_hari" id="denda_per_hari"
                                value="{{ old('denda_per_hari', $setting->denda_per_hari) }}"
                                class="block w-full rounded-lg border-gray-200 pl-14 pr-4 py-2.5 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700 transition-all @error('denda_per_hari') border-red-500 @enderror"
                                placeholder="0">
                        </div>
                        @error('denda_per_hari')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button id="" type="submit"
                    class="btn_simpan_perubahan bg-[#35094D] text-white py-2 px-10 cursor-pointer rounded mt-5 flex items-center gap-2">
                    <svg id="" class="spinner_load hidden animate-spin h-5 w-5 text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span class="text_simpan">Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </div>

@endsection
