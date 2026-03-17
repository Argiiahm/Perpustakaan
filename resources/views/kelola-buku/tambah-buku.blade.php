@extends('layouts.index')

@section('halaman', 'Kelola Buku')

@section('main')

    <section class="bg-white mt-10 p-10 rounded-lg">
        <form action="/kelola-buku" method="POST" class="all_form flex gap-12" enctype="multipart/form-data">
            @csrf
            <!-- Upload Area -->
            <div class="w-1/2 flex justify-center items-center">
                <div id="dropArea"
                    class="w-[320px] h-[260px] border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center text-center p-6 relative">
                    <img id="previewImage" class="hidden w-32 h-40 object-cover mb-3 rounded">
                    <img id="uploadIcon" src="{{ asset('icons/svg/upload.svg') }}" class="w-20 mb-4" alt="upload">
                    <p id="uploadText" class="text-purple-900 font-semibold">Drop File Here</p>
                    <p class="text-sm text-gray-500 mb-3">Or</p>

                    <label class="bg-[#35094D] text-white px-4 py-2 rounded cursor-pointer text-sm">
                        Upload File
                        <input name="cover_buku" type="file" id="imageInput" class="hidden">
                    </label>
                    <p class="text-xs mt-4 @error('cover_buku') text-red-500 @else text-gray-400 @enderror">
                        Hanya Mendukung File Berbentuk <br>
                        Png, Jpg, Jpeg, webp
                    </p>
                </div>
            </div>

            <!-- Form -->
            <div class="w-1/2 space-y-4">
                <div>
                    <label class="text-gray-600 text-sm font-semibold">Kode Buku*</label>
                    @error('kode_buku')
                        <div class="text-red-500 text-[14px]">{{ $message }}</div>
                    @enderror
                    <input type="text" placeholder="Kode buku" name="kode_buku"
                        class="w-full border rounded-md px-4 py-2 mt-1 border-gray-300 text-gray-400"
                        value="{{ old('kode_buku') }}">
                </div>

                <div>
                    <label class="text-gray-600 text-sm font-semibold">Judul Buku*</label>
                    @error('judul_buku')
                        <div class="text-red-500 text-[14px]">{{ $message }}</div>
                    @enderror
                    <input type="text" placeholder="Judul Buku" name="judul_buku"
                        class="w-full border rounded-md px-4 py-2 mt-1 border-gray-300 text-gray-400"
                        value="{{ old('judul_buku') }}">
                </div>

                <div>
                    <label class="text-gray-600 text-sm font-semibold">Penulis*</label>
                    @error('penulis')
                        <div class="text-red-500 text-[14px]">{{ $message }}</div>
                    @enderror
                    <input type="text" placeholder="Penulis" name="penulis"
                        class="w-full border rounded-md px-4 py-2 mt-1 border-gray-300 text-gray-400"
                        value="{{ old('penulis') }}">
                </div>

                <div>
                    <label class="text-gray-600 text-sm font-semibold">Tahun terbit*</label>
                    @error('tahun_terbit')
                        <div class="text-red-500 text-[14px]">{{ $message }}</div>
                    @enderror
                    <input name="tahun_terbit" type="date"
                        class="w-full border rounded-md px-4 py-2 mt-1 border-gray-300 text-gray-400"
                        value="{{ old('tahun_terbit') }}">
                </div>


                <div>
                    <label class="text-gray-600 text-sm font-semibold">Stok Buku*</label>
                    @error('stok_buku')
                        <div class="text-red-500 text-[14px]">{{ $message }}</div>
                    @enderror
                    <input type="number" placeholder="Stok Buku" name="stok_buku"
                        class="w-full border rounded-md px-4 py-2 mt-1 border-gray-300 text-gray-400"
                        value="{{ old('stok_buku') }}">
                </div>

                <!-- Button -->
                <div class="flex gap-4 pt-4">
                    <button type="button" onclick="window.location='/kelola-buku'"
                        class="px-6 py-2 border border-purple-900 text-purple-900 rounded-md">
                        Kembali
                    </button>

                    <button id="" type="submit"
                        class="btn_simpan_perubahan bg-[#35094D] text-white py-2 px-10 cursor-pointer rounded flex items-center gap-2">
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
            </div>
        </form>
    </section>
@endsection
