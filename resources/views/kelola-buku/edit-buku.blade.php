@extends('layouts.index')

@section('halaman', 'Kelola Buku')

@section('main')

    <section class="bg-white mt-10 p-10 rounded-lg">
        <form action="/kelola-buku/{{ $buku->id }}" method="POST" class="all_form flex gap-12"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="w-1/2 flex justify-center items-center">
                <div class="w-[350px] flex flex-col items-center text-center relative">

                    <div class="mb-6">
                        <img id="previewImage"
                            src="{{ $buku->cover_buku ? asset('storage/' . $buku->cover_buku) : asset('icons/no-image.jpg') }}"
                            class="photoPreview w-[120px] h-auto shadow-lg rounded-sm object-cover" alt="Cover Buku">
                    </div>
                    <input name="cover_buku" type="file" id="imageInput" class="photoInput hidden">

                    <button type="button"
                        class="uploadBtn bg-[#35094D] hover:bg-[#4a0d6b] text-white px-8 py-2 rounded-md cursor-pointer text-sm font-semibold transition-colors duration-200">
                        Edit Cover
                    </button>

                    <p class="text-xs mt-6 text-gray-400 font-medium @error('cover_buku') text-red-500 @enderror">
                        Hanya Mendukung File Berbentuk <br>
                        Png, Jpg, Jpeg
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
                        value="{{ $buku->kode_buku }}">
                </div>

                <div>
                    <label class="text-gray-600 text-sm font-semibold">Judul Buku*</label>
                    @error('judul_buku')
                        <div class="text-red-500 text-[14px]">{{ $message }}</div>
                    @enderror
                    <input type="text" placeholder="Judul Buku" name="judul_buku"
                        class="w-full border rounded-md px-4 py-2 mt-1 border-gray-300 text-gray-400"
                        value="{{ $buku->judul_buku }}">
                </div>

                <div>
                    <label class="text-gray-600 text-sm font-semibold">Penulis*</label>
                    @error('penulis')
                        <div class="text-red-500 text-[14px]">{{ $message }}</div>
                    @enderror
                    <input type="text" placeholder="Penulis" name="penulis"
                        class="w-full border rounded-md px-4 py-2 mt-1 border-gray-300 text-gray-400"
                        value="{{ $buku->penulis }}">
                </div>

                <div>
                    <label class="text-gray-600 text-sm font-semibold">Tahun terbit*</label>
                    @error('tahun_terbit')
                        <div class="text-red-500 text-[14px]">{{ $message }}</div>
                    @enderror
                    <input name="tahun_terbit" type="date"
                        class="w-full border rounded-md px-4 py-2 mt-1 border-gray-300 text-gray-400"
                        value="{{ $buku->tahun_terbit }}">
                </div>


                <div>
                    <label class="text-gray-600 text-sm font-semibold">Stok Buku*</label>
                    @error('stok_buku')
                        <div class="text-red-500 text-[14px]">{{ $message }}</div>
                    @enderror
                    <input type="number" placeholder="Stok Buku" name="stok_buku"
                        class="w-full border rounded-md px-4 py-2 mt-1 border-gray-300 text-gray-400"
                        value="{{ $buku->stok_buku }}">
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
