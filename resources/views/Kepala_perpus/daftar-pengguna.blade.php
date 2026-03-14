@extends('layouts.index')

@section('halaman', 'Daftar Pengguna')

@section('main')

    {{-- Searching Dan Btn Tambah Pengguna --}}
    <section class="flex justify-between items-center">
        {{-- Searching --}}
        <div class="mt-20">
            <form action="/daftar-pengguna" method="GET" class="form-cari flex items-center gap-2">
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
            <a href="/daftar-pengguna/tambah-pengguna"
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
                            <td class="py-4 px-4 capitalize">{{ $user->username }}</td>
                            {{-- Nama Lengkap ANggota --}}
                            @if ($user->role === 'anggota')
                                <td class="py-4">{{ $user->Anggota->nama_lengkap ?? 'N/A' }}</td>

                                {{-- Nama Lengkap Petugas --}}
                            @elseif($user->role === 'petugas')
                                <td class="py-4">{{ $user->Petugas->nama_lengkap ?? 'N/A' }}</td>

                                {{-- Nama Lengkap Kepala Perpustakaan --}}
                            @elseif($user->role === 'kepala_perpus')
                                <td class="py-4">{{ $user->KepalaPerpus->nama_lengkap ?? 'N/A' }}</td>
                            @endif
                            <td class="py-4">{{ $user->email }}</td>
                            <td class="py-4">{{ $user->no_telepon ?? 'N/A' }}</td>
                            {{-- NIK/NIS Anggota --}}
                            @if ($user->role === 'anggota')
                                <td class="py-4">{{ $user->Anggota->nomer_induk ?? 'N/A' }}</td>

                                {{-- NIK/NIS Petugas --}}
                            @elseif($user->role === 'petugas')
                                <td class="py-4">{{ $user->Petugas->nomer_induk ?? 'N/A' }}</td>

                                {{-- NIK/NIS Kepala Perpustakaan --}}
                            @elseif($user->role === 'kepala_perpus')
                                <td class="py-4">{{ $user->KepalaPerpus->nomer_induk ?? 'N/A' }}</td>
                            @endif
                            <td class="py-4">{{ $user->role }}</td>
                            <td class="py-4">
                                <div class="flex items-center gap-2">
                                    <a href="/daftar-pengguna/detail/pengguna_perpustakaan={{ $user->id }}">
                                        <img src="{{ asset('icons/svg/eye-detail.svg') }}" alt="">
                                    </a>
                                    <a href="/daftar-pengguna/edit/pengguna_perpustakaan={{ $user->id }}">
                                        <img src="{{ asset('icons/svg/pen.svg') }}" alt="">
                                    </a>
                                    <div class="btn_open_delete cursor-pointer" data-user-id="{{ $user->id }}">
                                        <img src="{{ asset('icons/svg/trash.svg') }}" alt="">
                                    </div>
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
            <div class="mt-6">
                {{ $Users->links() }}
            </div>
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

    {{-- Modal Delete Pengguna --}}
    <section
        class="open_modal_delete_pengguna hidden fixed inset-0 bg-black/40 backdrop-blur-sm flex justify-center items-center z-50">
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
                    class="btn_close_delete_pengguna border border-gray-200 text-[#35094D] px-10 py-2 rounded-full cursor-pointer">
                    Batal
                </button>
                <form class="delete_form_pengguna" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="btn_delete_pengguna bg-[#35094D] text-white px-10 py-2 rounded-full flex items-center justify-center gap-2 min-w-[140px]">
                        <span class="text_close_delete_pengguna">Ya, Hapus</span>
                        <svg class="spinner_delete hidden animate-spin h-5 w-5 text-white"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                            </path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </section>

    {{-- Modal Berhasil --}}
    @if (session('success'))
        <section class="success_modal fixed inset-0 bg-black/40 backdrop-blur-sm flex justify-center items-center z-50">
            <div class="bg-white p-6 w-full max-w-[32rem] rounded-xl">

                {{-- Keterangan Modal --}}
                <div class="flex flex-col items-center gap-4">
                    <img class="w-32" src="{{ asset('icons/svg/lamp-success.svg') }}" alt="">
                    <span class="text-[#35094D] font-bold text-center">
                        {{ session('success') }}
                    </span>
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end my-6">
                    <button class="close_modal_success bg-[#35094D] text-white px-10 py-2 rounded-full cursor-pointer">
                        Kembali
                    </button>
                </div>
            </div>
        </section>
        <script>
            document.querySelector('.close_modal_success')?.addEventListener('click', function() {
                document.querySelector('.success_modal').remove();
                location.reload();
            });
        </script>
    @endif

    {{-- Modal Gagal --}}
    @if (session('error'))
        <section class="success_modal fixed inset-0 bg-black/40 backdrop-blur-sm flex justify-center items-center z-50">
            <div class="bg-white p-6 w-full max-w-[30rem] rounded-xl">

                {{-- Keterangan Modal --}}
                <div class="flex flex-col items-center gap-4">
                    <img class="w-52 -ml-20" src="{{ asset('icons/svg/oops.svg') }}" alt="">
                    <span class="text-[#35094D] font-bold text-center">
                        {!! session('error') !!}
                    </span>
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end my-6">
                    <button class="close_modal_success bg-[#35094D] text-white px-10 py-2 rounded-full cursor-pointer">
                        Kembali
                    </button>
                </div>
            </div>
        </section>
        <script>
            document.querySelector('.close_modal_success')?.addEventListener('click', function() {
                document.querySelector('.success_modal').remove();
                location.reload();
            });
        </script>
    @endif

@endsection
