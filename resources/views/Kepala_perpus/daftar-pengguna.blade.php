@extends('layouts.index')

@section('main')
    {{-- Header --}}
    <section>
        <h1 class="text-[30px] text-[#35094D]">Hallo, <span
                class="font-semibold">{{ Auth::user()->KepalaPerpus->nama_lengkap ?? Auth::user()->username }}</span></h1>
        <span class="text-[#35094d90]">Selamat Datang Kembali Di Halaman <span
                class="font-medium text-[#35094D]">Dashboard</span> Anda!</span>
    </section>

    {{-- Searching Dan Btn Tambah Pengguna --}}
    <section class="flex justify-between items-center">
        {{-- Searching --}}
        <div class="mt-20">
            <form action="/cari-pengguna" method="GET" class="form-cari flex items-center gap-2">
                @csrf
                <div class="relative w-full max-w-[450px]">
                    <div class="absolute inset-y-0 left-4 flex items-center">
                        <img src="{{ asset('icons/svg/Search.svg') }}" alt="">
                    </div>
                    <input name="cari" type="text" placeholder="Cari Username, NIK/NIS, Email, Nama Lengkap...."
                        class="bg-white w-full pl-12 pr-4 py-3 rounded-md placeholder:text-gray-300 border border-gray-200"
                        value="{{ request('cari') }}">
                </div>
                <button type="submit"
                    class="bg-[#35094D] text-white px-6 py-3 rounded-md hover:bg-[#2a073a] transition duration-300 cursor-pointer">Cari</button>
            </form>
        </div>
        {{-- Btn Tambah Pengguna --}}
        <div>
            <a href="/tambah-pengguna"
                class="flex item-center gap-2 mt-6 border border-gray-200 text-[#35094D] px-6 py-3 rounded-md">
                <img src="{{ asset('icons/svg/pengguna-aktif.svg') }}" alt="">
                Tambah Pengguna</a>
        </div>
    </section>

    {{-- Table Daftar Pengguna --}}
    <section>
        <div class="w-full rounded-xl mt-4 p-6">
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-gray-200">
                        <th class="pb-4 text-gray-400 font-normal">Profile</th>
                        <th class="pb-4 text-gray-400 font-normal">Username</th>
                        <th class="pb-4 text-gray-400 font-normal">Nama Lengkap</th>
                        <th class="pb-4 text-gray-400 font-normal">Email</th>
                        <th class="pb-4 text-gray-400 font-normal">No Telp</th>
                        <th class="pb-4 text-gray-400 font-normal">NIK/NIS</th>
                        <th class="pb-4 text-gray-400 font-normal">Peran/Role</th>
                        <th class="pb-4 text-gray-400 font-normal">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[#35094D] font-medium">
                    @forelse ($Users as $user)
                        <tr class="border-b border-gray-200">
                            <td class="py-4">
                                <img class="photoPreview w-14 h-14 object-cover border border-gray-200 p-1" id=""
                                    src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('icons/default-avatar.png') }}"
                                    alt="">
                            </td>
                            <td class="py-4">{{ $user->username }}</td>
                            {{-- Nama Lengkap ANggota --}}
                            @if ($user->role === 'anggota')
                                <td class="py-4">{{ $user->Anggota->nama_lengkap ?? 'N/A' }}</td>
                            @elseif($user->role === 'kepala_perpus')
                                {{-- Nama Lengkap Kepala Perpustakaan --}}
                                <td class="py-4">{{ $user->KepalaPerpus->nama_lengkap ?? 'N/A' }}</td>
                            @endif
                            <td class="py-4">{{ $user->email }}</td>
                            <td class="py-4">{{ $user->no_telepon ?? 'N/A' }}</td>
                            {{-- NIK/NIS Anggota --}}
                            @if ($user->role === 'anggota')
                                <td class="py-4">{{ $user->Anggota->nomer_induk ?? 'N/A' }}</td>
                            @elseif($user->role === 'kepala_perpus')
                                {{-- NIK/NIS Kepala Perpustakaan --}}
                                <td class="py-4">{{ $user->KepalaPerpus->nomer_induk ?? 'N/A' }}</td>
                            @endif
                            <td class="py-4">{{ $user->role }}</td>
                            <td class="py-4">
                                <div class="flex items-center gap-2">
                                    <a href="">
                                        <img src="{{ asset('icons/svg/eye-detail.svg') }}" alt="">
                                    </a>
                                    <a href="">
                                        <img src="{{ asset('icons/svg/pen.svg') }}" alt="">
                                    </a>
                                    <a href="">
                                        <img src="{{ asset('icons/svg/trash.svg') }}" alt="">
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-gray-500">Tidak ada pengguna yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{-- Modal Loading Searcing --}}
    <section id=""
        class="open_modal_loading hidden fixed inset-0 bg-black/40 backdrop-blur-sm flex justify-center items-center z-50">
        <div class="bg-white p-6 w-full max-w-[32rem] rounded-xl">
            <div class="flex justify-center gap-4 my-6">
                {{-- Spinner Loading --}}
                <svg id="loading_spinner" class="hidden animate-spin h-5 w-5 text-gray-500"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                    </circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <span class="text-loading"></span>
            </div>
        </div>
    </section>


    {{-- JS Loading Modal Mencari Pengguna --}}
    <script>
        const formCari = document.querySelector('.form-cari');
        const loading_spinner = document.querySelector('#loading_spinner');
        const text_loading = document.querySelector('.text-loading');
        const modalLoading = document.querySelector('.open_modal_loading');

        formCari.addEventListener("submit", function() {
            modalLoading.classList.remove("hidden");
            loading_spinner.classList.remove("hidden");
            text_loading.textContent = "Sedang mencari pengguna...";
        });
    </script>
@endsection
