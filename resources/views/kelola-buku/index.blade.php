@extends('layouts.index')

@section('halaman', 'Kelola Buku')

@section('main')


    {{-- Filter --}}
    <section class="mt-20 mb-8 flex justify-between items-center">
        <div>
            {{-- Tambah Buku Button --}}
            <a href="/kelola-buku/tambah-buku"
                class="flex items-center gap-2 mt-6 border text-white bg-[#35094D] px-6 py-3 rounded-md">
                <img src="{{ asset('icons/svg/add-buku-icon.svg') }}" alt="">
                <span>Tambah Buku</span>
            </a>
        </div>
        <div class="">
            {{-- Searching Buku --}}
            <form action="/kelola-buku" method="GET" class="form-cari flex items-center gap-2">
                @csrf
                <div class="relative w-full max-w-[450px]">
                    <div class="absolute inset-y-0 left-4 flex items-center">
                        <img src="{{ asset('icons/svg/Search.svg') }}" alt="">
                    </div>
                    <input name="cari" type="text" placeholder="Cari kode buku, judul buku...."
                        class="bg-white w-full pl-12 pr-4 py-3 rounded-md placeholder:text-gray-300 border border-gray-200"
                        value="{{ request('cari') }}">
                </div>
                <button type="submit"
                    class="bg-[#35094D] text-white px-6 py-3 rounded-md hover:bg-[#2a073a] transition duration-300 cursor-pointer">Cari</button>
            </form>
        </div>
    </section>

    {{-- Table Pinjaman Aktif, Pending Dan Kembalikan(Pending) --}}
    <section>
        <div class="bg-white w-full rounded-xl mt-4 p-6">
            <div class="font-medium pb-4">Aktif</div>
            {{-- Table Riwayat Aktif (Pending Dan Aktif) --}}
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-gray-200">
                        <th class="pb-4 text-center text-gray-400 font-normal">Cover</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Kode Buku</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Judul Buku</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Penulis</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tahun Terbit</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Stok Buku</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[#35094D]">
                    @forelse ($Bukus as $buku)
                        <tr class="border-b border-gray-200">
                            <td class="py-4 flex justify-center">
                                <img class="w-10"
                                    src="{{ $buku->cover_buku ? asset('storage/' . $buku->cover_buku) : asset('icons/no-image.jpg') }}"
                                    alt="{{ $buku->judul_buku ?? 'Cover buku' }}">
                            </td>
                            <td class="py-4 text-center">{{ $buku->kode_buku ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $buku->judul_buku ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $buku->penulis ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $buku->tahun_terbit ?? 'N/A' }}</td>
                            <td class="py-4 text-center">
                                @if ($buku->stok_buku === 0)
                                    <span class="bg-red-200 text-red-500 px-6 py-2 rounded-full">
                                        {{ $buku->stok_buku ?? 'N/A' }}
                                    </span>
                                @elseif ($buku->stok_buku <= 4)
                                    <span class="bg-yellow-100 text-yellow-500 px-6 py-2 rounded-full">
                                        {{ $buku->stok_buku ?? 'N/A' }}
                                    </span>
                                @else
                                    <span class="bg-[#16C09861] text-[#008767] px-6 py-2 rounded-full">
                                        {{ $buku->stok_buku ?? 'N/A' }}
                                    </span>
                                @endif
                            </td>
                            {{-- Aksi --}}
                            <td class="py-4 text-center">
                                <button onclick=window.location='/kelola-buku/{{ $buku->id }}'
                                    class="btn_open_modal_kembalikan bg-[#F99D2282] cursor-pointer text-white px-6 py-2 rounded-full">
                                    Edit
                                </button>
                                <button 
                                    class="btn_open_delete_buku bg-[#FFC5C5] cursor-pointer text-white px-6 py-2 rounded-full" data-buku-id={{ $buku->id }}>
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-gray-500">Tidak ada buku yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-6">
                {{ $Bukus->links() }}
            </div>
        </div>

        {{-- Modal Loading Searcing --}}
        <section id=""
            class="open_modal_loading hidden fixed inset-0 bg-black/40 backdrop-blur-sm flex justify-center items-center z-50">
            <div class="bg-white p-6 w-full max-w-[32rem] rounded-xl">
                <div class="flex justify-center gap-4 my-6">
                    {{-- Spinner Loading --}}
                    <svg id="loading_spinner" class="hidden animate-spin h-5 w-5 text-gray-500"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span class="text-loading"></span>
                </div>
            </div>
        </section>

        {{-- Modal Delete Pengguna --}}
        <section
            class="open_modal_delete_buku hidden fixed inset-0 bg-black/40 backdrop-blur-sm flex justify-center items-center z-50">
            <div class="bg-white p-8 w-full max-w-[32rem] rounded-xl">
                <div class="flex flex-col items-center gap-4">
                    <img class="w-36" src="{{ asset('icons/svg/delete-icon.svg') }}" alt="">
                    <span class="text-[#35094D] font-bold text-center">
                        Yakin ingin Hapus pengguna ini? <br>
                        <span class="font-normal text-[14px]">Tindakan Ini Akan Hapus Data Secara Permanen.</span>
                    </span>
                </div>
                <div class="flex justify-center gap-4 my-6">
                    <button
                        class="btn_close_delete_buku border border-gray-200 text-[#35094D] px-10 py-2 rounded-full cursor-pointer">
                        Batal
                    </button>
                    <form class="delete_form_buku" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="btn_delete_buku bg-[#35094D] text-white px-10 py-2 rounded-full flex items-center justify-center gap-2 min-w-[140px]">
                            <span class="text_close_delete_buku">Ya, Hapus</span>
                            <svg class="spinner_delete hidden animate-spin h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                                </path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </section>
@endsection
