<section class="bg-[#FFFFFF] w-full max-w-[316px] h-screen px-10 py-8">
    {{-- Logo --}}
    <div class="flex items-center gap-3">
        <div>
            <img src="{{ asset('icons/logo.png') }}" alt="logo">
        </div>
        <div class="flex flex-col">
            <span class="text-[22px] text-[#35094D] font-medium">Perpustakaaan</span>
            <span class="text-[16px] text-[#35094D] transform translate-y-[-8px]">Saya</span>
        </div>
    </div>
    {{-- Keterangan Masuk Sebagai --}}
    <div class="mt-10 flex items-center gap-4 border border-gray-200 rounded-2xl p-3">
        <div>
            <img src="{{ asset('icons/svg/default-profile-sidebar.svg') }}" alt="">
        </div>
        <div class="flex flex-col">
            <span class="text-[14px] font-medium text-[#35094D]">Anda Masuk Sebagai :</span>
            <span class="text-[10px] text-[#35094d90] capitalize">{{ Auth::user()->username }} -
                {{ Auth::user()->role }}#{{ Auth::user()->id }}</span>
        </div>
    </div>

    {{-- List Menu --}}
    <div class="my-5">
        {{-- UMUM --}}
        <div class="mb-5">
            <span class="text-[10px] font-medium text-[#35094d90]">UMUM</span>
            <ul>
                {{-- Dashboard Anggota --}}
                @role('anggota')
                    <li class="mt-4">
                        <a class="{{ request()->is('dashboard-anggota*') ? ' text-[#35094D] font-medium' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px] font-medium"
                            href="/dashboard-anggota">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('dashboard-anggota*') ? asset('icons/svg/dashboard-active.svg') : asset('icons/svg/dashboard-inactive.svg') }}"
                                    class="w-5 h-5 object-contain" alt="">
                            </div>
                            <span>Dashboard</span>
                        </a>
                    </li>
                @endrole
                {{-- Dashboard Petugas --}}
                @role('petugas')
                    <li class="mt-4">
                        <a class="{{ request()->is('dashboard-petugas*') ? ' text-[#35094D] font-medium' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px] font-medium"
                            href="/dashboard-petugas">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('dashboard-petugas*') ? asset('icons/svg/dashboard-active.svg') : asset('icons/svg/dashboard-inactive.svg') }}"
                                    class="w-5 h-5 object-contain" alt="">
                            </div>
                            <span>Dashboard</span>
                        </a>
                    </li>
                @endrole
                {{-- Dashboard Kepala Perpustakaan --}}
                @role('kepala_perpus')
                    <li class="mt-4">
                        <a class="{{ request()->is('dashboard-kepala-perpustakaan*') ? ' text-[#35094D] font-medium' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px] font-medium"
                            href="/dashboard-kepala-perpustakaan">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('dashboard-kepala-perpustakaan*') ? asset('icons/svg/dashboard-active.svg') : asset('icons/svg/dashboard-inactive.svg') }}"
                                    class="w-5 h-5 object-contain" alt="">
                            </div>
                            <span>Dashboard</span>
                        </a>
                    </li>
                @endrole
                {{-- Daftar Transaksi Kepala Perpustakaan --}}
                @role('kepala_perpus')
                    <li class="mt-4">
                        <a class="{{ request()->is('daftar-transaksi*') ? ' text-[#35094D] font-medium' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px] font-medium"
                            href="/daftar-transaksi">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('daftar-transaksi*') ? asset('icons/svg/transaksi-aktif.svg') : asset('icons/svg/transaksi-inaktif.svg') }}"
                                    class="w-6 h-6 object-contain" alt="">
                            </div>
                            <span>Transaksi</span>
                        </a>
                    </li>
                @endrole

                {{-- Daftar Transaksi Kepala Perpustakaan --}}
                @role('petugas')
                    <li class="mt-4">
                        <a class="{{ request()->is('pengajuan*') ? ' text-[#35094D] font-medium' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px] font-medium"
                            href="/pengajuan">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('pengajuan*') ? asset('icons/svg/transaksi-aktif.svg') : asset('icons/svg/transaksi-inaktif.svg') }}"
                                    class="w-6 h-6 object-contain" alt="">
                            </div>
                            <span>Pengajuan</span>
                        </a>
                    </li>
                @endrole

                {{-- RIwwayat Pinjaman Anggota --}}
                @role('anggota')
                    <li class="mt-4">
                        <a class="{{ request()->is('riwayat-pinjaman') ? ' text-[#35094D] font-medium' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]"
                            href="/riwayat-pinjaman">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('riwayat-pinjaman') ? asset('icons/svg/riwayat-pinjaman-aktif.svg') : asset('icons/svg/riwayat-pinjaman-inactive.svg') }}"
                                    class="w-7 h-7 object-contain" alt="">
                            </div>
                            <span>Riwayat Peminjaman</span>
                        </a>
                    </li>
                @endrole

                {{-- Daftar BUku Anggota --}}
                @role('anggota')
                    <li class="mt-4 ">
                        <a class="{{ request()->is('daftar-buku*') ? ' text-[#35094D] font-medium' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]"
                            href="/daftar-buku">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('daftar-buku*') ? asset('icons/svg/buku-aktif.svg') : asset('icons/svg/buku-inactive.svg') }}"
                                    class="w-5 h-5 object-contain" alt="">
                            </div>
                            <span>Daftar Buku</span>
                        </a>
                    </li>
                @endrole
            </ul>
        </div>

        {{-- LAINYA --}}
        <div class="mb-5">
            <span class="text-[10px] font-medium text-[#35094d90]">LAINYA</span>
            <ul>
                {{-- Daftar Buku - Kepala Perpustakaan --}}
                @role('kepala_perpus')
                    <li class="mt-4 ">
                        <a class="{{ request()->is('kelola-buku*') ? ' text-[#35094D] font-medium' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]"
                            href="/kelola-buku">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('kelola-buku*') ? asset('icons/svg/buku-aktif.svg') : asset('icons/svg/buku-inactive.svg') }}"
                                    class="w-5 h-5 object-contain" alt="">
                            </div>
                            <span>Daftar Buku</span>
                        </a>
                    </li>
                @endrole

                {{-- Daftar Buku - Petugas --}}
                @role('petugas')
                    <li class="mt-4 ">
                        <a class="{{ request()->is('kelola-buku*') ? ' text-[#35094D] font-medium' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]"
                            href="/kelola-buku">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('kelola-buku*') ? asset('icons/svg/buku-aktif.svg') : asset('icons/svg/buku-inactive.svg') }}"
                                    class="w-5 h-5 object-contain" alt="">
                            </div>
                            <span>Daftar Buku</span>
                        </a>
                    </li>
                @endrole

                {{-- Daftar Pengguna - Kepala perpustakaan --}}
                @role('kepala_perpus')
                    <li class="mt-4 ">
                        <a class="{{ request()->is('daftar-pengguna*') ? ' text-[#35094D] font-medium' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]"
                            href="/daftar-pengguna">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('daftar-pengguna*') ? asset('icons/svg/pengguna-aktif.svg') : asset('icons/svg/pengguna-inaktif.svg') }}"
                                    class="w-5 h-5 object-contain" alt="">
                            </div>
                            <span>Daftar Pengguna</span>
                        </a>
                    </li>
                @endrole

                {{-- Profile Anggota --}}
                @role('anggota')
                    <li class="mt-4 ">
                        <a class="{{ request()->is('profile-anggota*') ? ' text-[#35094D] font-medium' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]"
                            href="/profile-anggota">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('profile-anggota*') ? asset('icons/svg/profile-aktif.svg') : asset('icons/svg/profile-inactive.svg') }}"
                                    class="w-6 h-6 object-contain" alt="">
                            </div>
                            <span>Profile</span>
                        </a>
                    </li>
                @endrole

                {{-- Profile Petugas --}}
                @role('petugas')
                    <li class="mt-4 ">
                        <a class="{{ request()->is('profile-petugas*') ? ' text-[#35094D] font-medium' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]"
                            href="/profile-petugas">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('profile-petugas*') ? asset('icons/svg/profile-aktif.svg') : asset('icons/svg/profile-inactive.svg') }}"
                                    class="w-6 h-6 object-contain" alt="">
                            </div>
                            <span>Profile</span>
                        </a>
                    </li>
                @endrole

                {{-- Profile Kepala Perpus --}}
                @role('kepala_perpus')
                    <li class="mt-4 ">
                        <a class="{{ request()->is('profile-kepala-perpus*') ? ' text-[#35094D] font-medium' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]"
                            href="/profile-kepala-perpus">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('profile-kepala-perpus*') ? asset('icons/svg/profile-aktif.svg') : asset('icons/svg/profile-inactive.svg') }}"
                                    class="w-6 h-6 object-contain" alt="">
                            </div>
                            <span>Profile</span>
                        </a>
                    </li>
                @endrole

                {{-- Pemberitahuan --}}
                @role('anggota')
                    <li class="mt-4 ">
                        <a class="{{ request()->is('pemberitahuan*') ? ' text-[#35094D] font-medium' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]"
                            href="/pemberitahuan">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('pemberitahuan*') ? asset('icons/svg/lonceng-aktif.svg') : asset('icons/svg/lonceng-inactive.svg') }}"
                                    class="w-5 h-5 object-contain" alt="">
                            </div>
                            <span>Pemberitahuan</span>
                        </a>
                    </li>
                @endrole

            </ul>
        </div>
    </div>

    {{-- Logout --}}
    <button id=""
        class="btn_open_modal flex items-center justify-between bg-[#35094D] bottom-8 absolute w-full max-w-[240px] rounded-2xl p-3 text-[16px] text-white cursor-pointer">
        <img src="{{ asset('icons/svg/sign-out.svg') }}" class="w-5 h-5" alt="">
        <span class="text-center">
            Keluar
        </span>
        <div class="w-5 h-5"></div>
    </button>

    {{-- Modal Logout --}}
    <section id=""
        class="open_modal hidden fixed inset-0 bg-black/40 backdrop-blur-sm flex justify-center items-center z-50">
        <div class="bg-white p-6 w-full max-w-[32rem] rounded-xl">
            {{-- Keterangan Modal --}}
            <div class="flex flex-col items-center gap-4">
                <img class="w-20" src="{{ asset('icons/svg/warning.svg') }}" alt="">
                <span class="text-[#35094D] font-bold">Yakin Ingin Keluar Dari Akun Ini?</span>
            </div>

            {{-- Action Buttons --}}
            <div class="flex justify-center gap-4 my-6">
                <button id=""
                    class="btn_close border border-gray-200 text-[#35094D] px-10 py-2 rounded-full cursor-pointer">Nanti
                    Saja</button>

                <form id="logout_form" action="/logout" method="POST">
                    @csrf
                    <button type="submit" id="btn_logout"
                        class="bg-[#35094D] text-white px-10 py-2 rounded-full cursor-pointer flex items-center justify-center gap-2 min-w-[140px]">
                        <span id="text_logout">Ya, Keluar</span>
                        {{-- Spinner Loading --}}
                        <svg id="spinner" class="hidden animate-spin h-5 w-5 text-white"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </section>

    {{-- Script Loading Sniper Logout --}}
    <script>
        const logoutForm = document.getElementById('logout_form');
        const btnLogout = document.getElementById('btn_logout');
        const btnClose = document.querySelector('.btn_close');
        const spinner = document.getElementById('spinner');
        const textLogout = document.getElementById('text_logout');

        logoutForm.addEventListener('submit', function() {
            // Nonaktifkan tombol
            btnLogout.disabled = true;
            btnLogout.classList.add('opacity-70', 'cursor-not-allowed');

            // Sembunyikan tombol Nanti Saja
            btnClose.classList.add('hidden');

            // Tampilkan spinner dan ubah teks
            spinner.classList.remove('hidden');
            textLogout.innerText = 'Tunggu...';
        });
    </script>
</section>
