@extends('layouts.index')

@section('halaman', 'Kelola Buku')

@section('main')

    <section class="bg-white mt-20 p-10 rounded-lg shadow flex gap-12">
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
                    <input type="file" id="imageInput" accept="image/png,image/jpeg,image/jpg" class="hidden">
                </label>
                <p class="text-xs text-gray-400 mt-4">
                    Hanya Mendukung File Berbentuk <br>
                    Png, Jpg, Jpeg
                </p>
            </div>
        </div>

        <!-- Form -->
        <div class="w-1/2 space-y-4">
            <div>
                <label class="text-gray-600 text-sm font-semibold">Kode Buku*</label>
                <input type="text" placeholder="Kode buku"
                    class="w-full border rounded-md px-4 py-2 mt-1 border-gray-300 text-gray-400">
            </div>

            <div>
                <label class="text-gray-600 text-sm font-semibold">Penulis*</label>
                <input type="text" placeholder="Penulis"
                    class="w-full border rounded-md px-4 py-2 mt-1 border-gray-300 text-gray-400">
            </div>

            <div>
                <label class="text-gray-600 text-sm font-semibold">Tahun terbit*</label>
                <input type="date" class="w-full border rounded-md px-4 py-2 mt-1 border-gray-300 text-gray-400">
            </div>

            <div>
                <label class="text-gray-600 text-sm font-semibold">Judul Buku*</label>
                <input type="text" placeholder="Judul Buku"
                    class="w-full border rounded-md px-4 py-2 mt-1 border-gray-300 text-gray-400">
            </div>

            <div>
                <label class="text-gray-600 text-sm font-semibold">Stok Buku*</label>
                <input type="number" placeholder="Stok Buku"
                    class="w-full border rounded-md px-4 py-2 mt-1 border-gray-300 text-gray-400">
            </div>

            <!-- Button -->
            <div class="flex gap-4 pt-4">
                <button onclick="window.location='/kelola-buku'"
                    class="px-6 py-2 border border-purple-900 text-purple-900 rounded-md">
                    Kembali
                </button>

                <button class="px-6 py-2 bg-[#35094D] text-white rounded-md">
                    Tambahkan Buku
                </button>
            </div>
        </div>
    </section>
@endsection
