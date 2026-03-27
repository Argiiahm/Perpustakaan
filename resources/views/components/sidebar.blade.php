<section class="bg-[#FFFFFF] w-full max-w-[316px] h-screen px-10 py-8 relative">
    {{-- Logo --}}
    <div class="flex items-center gap-3">
        <div class="flex-shrink-0">
            <img src="{{ asset('icons/logo.png') }}" alt="logo">
        </div>
        <div class="flex flex-col">
            <span class="text-[22px] text-[#35094D] font-medium leading-none">Perpustakaaan</span>
            <span class="text-[16px] text-[#35094D] mt-1">Saya</span>
        </div>
    </div>

    {{-- Keterangan Masuk Sebagai --}}
    <div class="mt-10 flex items-center gap-4 border border-gray-200 rounded-2xl p-3">
        <div class="flex-shrink-0">
            <img src="{{ asset('icons/svg/default-profile-sidebar.svg') }}" alt="profile">
        </div>
        <div class="flex flex-col overflow-hidden">
            <span class="text-[14px] font-medium text-[#35094D]">Anda Masuk Sebagai :</span>
            <span class="text-[10px] text-[#35094d90] capitalize truncate">
                {{ Auth::user()->username }} - {{ Auth::user()->role }}#{{ Auth::user()->id }}
            </span>
        </div>
    </div>

    {{-- List Menu --}}
    <div class="my-5 overflow-y-auto max-h-[calc(100vh-350px)]">
        {{-- UMUM --}}
        <div class="mb-5">
            <span class="text-[10px] font-medium text-[#35094d90] tracking-wider">UMUM</span>
            <ul class="mt-2 space-y-4">
                {{-- Dashboard Anggota --}}
                @role('anggota')
                    <li>
                        <a href="/dashboard-anggota" class="{{ request()->is('dashboard-anggota*') ? 'text-[#35094D] font-semibold' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('dashboard-anggota*') ? asset('icons/svg/dashboard-active.svg') : asset('icons/svg/dashboard-inactive.svg') }}" class="w-5 h-5 object-contain" alt="">
                            </div>
                            <span>Dashboard</span>
                        </a>
                    </li>
                @endrole

                {{-- Dashboard Petugas --}}
                @role('petugas')
                    <li>
                        <a href="/dashboard-petugas" class="{{ request()->is('dashboard-petugas*') ? 'text-[#35094D] font-semibold' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('dashboard-petugas*') ? asset('icons/svg/dashboard-active.svg') : asset('icons/svg/dashboard-inactive.svg') }}" class="w-5 h-5 object-contain" alt="">
                            </div>
                            <span>Dashboard</span>
                        </a>
                    </li>
                @endrole

                {{-- Dashboard Kepala Perpustakaan --}}
                @role('kepala_perpus')
                    <li>
                        <a href="/dashboard-kepala-perpustakaan" class="{{ request()->is('dashboard-kepala-perpustakaan*') ? 'text-[#35094D] font-semibold' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('dashboard-kepala-perpustakaan*') ? asset('icons/svg/dashboard-active.svg') : asset('icons/svg/dashboard-inactive.svg') }}" class="w-5 h-5 object-contain" alt="">
                            </div>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="/daftar-transaksi" class="{{ request()->is('daftar-transaksi*') ? 'text-[#35094D] font-semibold' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('daftar-transaksi*') ? asset('icons/svg/transaksi-aktif.svg') : asset('icons/svg/transaksi-inaktif.svg') }}" class="w-6 h-6 object-contain" alt="">
                            </div>
                            <span>Transaksi</span>
                        </a>
                    </li>
                @endrole

                {{-- Fitur Petugas --}}
                @role('petugas')
                    <li>
                        <a href="/pengajuan" class="{{ request()->is('pengajuan*') ? 'text-[#35094D] font-semibold' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('pengajuan*') ? asset('icons/svg/transaksi-aktif.svg') : asset('icons/svg/transaksi-inaktif.svg') }}" class="w-6 h-6 object-contain" alt="">
                            </div>
                            <span>Pengajuan</span>
                        </a>
                    </li>
                    <li>
                        <a href="/pengembalian" class="{{ request()->is('pengembalian*') ? 'text-[#35094D] font-semibold' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('pengembalian*') ? asset('icons/svg/transaksi-aktif.svg') : asset('icons/svg/transaksi-inaktif.svg') }}" class="w-6 h-6 object-contain rotate-180" alt="">
                            </div>
                            <span>Pengembalian</span>
                        </a>
                    </li>
                    <li>
                        <a href="/kelola-buku" class="{{ request()->is('kelola-buku*') ? 'text-[#35094D] font-semibold' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('kelola-buku*') ? asset('icons/svg/buku-aktif.svg') : asset('icons/svg/buku-inactive.svg') }}" class="w-5 h-5 object-contain" alt="">
                            </div>
                            <span>Daftar Buku</span>
                        </a>
                    </li>
                @endrole

                {{-- Fitur Anggota --}}
                @role('anggota')
                    <li>
                        <a href="/riwayat-pinjaman" class="{{ request()->is('riwayat-pinjaman') ? 'text-[#35094D] font-semibold' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('riwayat-pinjaman') ? asset('icons/svg/riwayat-pinjaman-aktif.svg') : asset('icons/svg/riwayat-pinjaman-inactive.svg') }}" class="w-7 h-7 object-contain" alt="">
                            </div>
                            <span>Riwayat Peminjaman</span>
                        </a>
                    </li>
                    <li>
                        <a href="/daftar-buku" class="{{ request()->is('daftar-buku*') ? 'text-[#35094D] font-semibold' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('daftar-buku*') ? asset('icons/svg/buku-aktif.svg') : asset('icons/svg/buku-inactive.svg') }}" class="w-5 h-5 object-contain" alt="">
                            </div>
                            <span>Daftar Buku</span>
                        </a>
                    </li>
                @endrole
            </ul>
        </div>

        {{-- LAINNYA --}}
        <div>
            <span class="text-[10px] font-medium text-[#35094d90] tracking-wider">LAINNYA</span>
            <ul class="mt-2 space-y-4">
                @role('kepala_perpus')
                    <li>
                        <a href="/kelola-buku" class="{{ request()->is('kelola-buku*') ? 'text-[#35094D] font-semibold' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('kelola-buku*') ? asset('icons/svg/buku-aktif.svg') : asset('icons/svg/buku-inactive.svg') }}" class="w-5 h-5 object-contain" alt="">
                            </div>
                            <span>Daftar Buku</span>
                        </a>
                    </li>
                    <li>
                        <a href="/daftar-pengguna" class="{{ request()->is('daftar-pengguna*') ? 'text-[#35094D] font-semibold' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('daftar-pengguna*') ? asset('icons/svg/pengguna-aktif.svg') : asset('icons/svg/pengguna-inaktif.svg') }}" class="w-5 h-5 object-contain" alt="">
                            </div>
                            <span>Daftar Pengguna</span>
                        </a>
                    </li>
                    <li>
                        <a href="/profile-kepala-perpus" class="{{ request()->is('profile-kepala-perpus*') ? 'text-[#35094D] font-semibold' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('profile-kepala-perpus*') ? asset('icons/svg/profile-aktif.svg') : asset('icons/svg/profile-inactive.svg') }}" class="w-6 h-6 object-contain" alt="">
                            </div>
                            <span>Profile</span>
                        </a>
                    </li>
                @endrole

                @role('petugas')
                    <li>
                        <a href="/aktivitas" class="{{ request()->is('aktivitas*') ? 'text-[#35094D] font-semibold' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('aktivitas*') ? asset('icons/svg/activity-aktif.svg') : asset('icons/svg/aktifity-inaktif.svg') }}" class="w-8 h-8 object-contain" alt="">
                            </div>
                            <span>Aktivitas Saya</span>
                        </a>
                    </li>
                    <li>
                        <a href="/kelola-laporan" class="{{ request()->is('kelola-laporan*') ? 'text-[#35094D] font-semibold' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('kelola-laporan*') ? asset('icons/svg/laporan-aktif.svg') : asset('icons/svg/laporan-inaktif.svg') }}" class="w-5 h-5 object-contain" alt="">
                            </div>
                            <span>Laporan</span>
                        </a>
                    </li>
                    <li>
                        <a href="/profile-petugas" class="{{ request()->is('profile-petugas*') ? 'text-[#35094D] font-semibold' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('profile-petugas*') ? asset('icons/svg/profile-aktif.svg') : asset('icons/svg/profile-inactive.svg') }}" class="w-6 h-6 object-contain" alt="">
                            </div>
                            <span>Profile</span>
                        </a>
                    </li>
                @endrole

                @role('anggota')
                    <li>
                        <a href="/tagihan" class="{{ request()->is('tagihan*') ? 'text-[#35094D] font-semibold' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('tagihan*') ? asset('icons/svg/payment-aktif.svg') : asset('icons/svg/payment-inaktif.svg') }}" class="w-6 h-6 object-contain" alt="">
                            </div>
                            <span>Tagihan</span>
                        </a>
                    </li>
                    <li>
                        <a href="/profile-anggota" class="{{ request()->is('profile-anggota*') ? 'text-[#35094D] font-semibold' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('profile-aktif.svg') ? asset('icons/svg/profile-aktif.svg') : asset('icons/svg/profile-inactive.svg') }}" class="w-6 h-6 object-contain" alt="">
                            </div>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="/pemberitahuan" class="{{ request()->is('pemberitahuan*') ? 'text-[#35094D] font-semibold' : 'text-[#35094d90]' }} flex items-center gap-2 text-[16px]">
                            <div class="w-6 h-6 flex items-center justify-center">
                                <img src="{{ request()->is('pemberitahuan*') ? asset('icons/svg/lonceng-aktif.svg') : asset('icons/svg/lonceng-inactive.svg') }}" class="w-5 h-5 object-contain" alt="">
                            </div>
                            <span>Pemberitahuan</span>
                        </a>
                    </li>
                @endrole
            </ul>
        </div>
    </div>

    {{-- Logout Button --}}
    <div class="absolute bottom-8 left-10 right-10">
        <button class="btn_open_modal flex items-center justify-between bg-[#35094D] w-full rounded-2xl p-3 text-[16px] text-white cursor-pointer hover:bg-[#2a073d] transition-colors">
            <img src="{{ asset('icons/svg/sign-out.svg') }}" class="w-5 h-5" alt="">
            <span class="font-medium">Keluar</span>
            <div class="w-5 h-5"></div>
        </button>
    </div>

    {{-- Modal Logout --}}
    <section class="open_modal hidden fixed inset-0 bg-black/40 backdrop-blur-sm flex justify-center items-center z-50">
        <div class="bg-white p-8 w-full max-w-md rounded-2xl shadow-xl">
            <div class="flex flex-col items-center text-center gap-4">
                <img class="w-20" src="{{ asset('icons/svg/warning.svg') }}" alt="warning">
                <h3 class="text-[#35094D] font-bold text-xl">Yakin Ingin Keluar?</h3>
                <p class="text-gray-500 text-sm">Anda harus login kembali untuk mengakses data perpustakaan.</p>
            </div>

            <div class="flex justify-center gap-4 mt-8">
                <button class="btn_close border border-gray-300 text-[#35094D] px-8 py-2.5 rounded-full font-medium hover:bg-gray-50 transition-all">
                    Nanti Saja
                </button>

                <form id="logout_form" action="/logout" method="POST">
                    @csrf
                    <button type="submit" id="btn_logout" class="bg-[#35094D] text-white px-8 py-2.5 rounded-full font-medium flex items-center justify-center gap-2 min-w-[140px] hover:bg-[#2a073d] transition-all">
                        <span id="text_logout">Ya, Keluar</span>
                        <svg id="spinner" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <script>
        // Logika Modal sederhana
        const openModalBtn = document.querySelector('.btn_open_modal');
        const closeModalBtn = document.querySelector('.btn_close');
        const modal = document.querySelector('.open_modal');
        
        openModalBtn.addEventListener('click', () => modal.classList.remove('hidden'));
        closeModalBtn.addEventListener('click', () => modal.classList.add('hidden'));

        // Logika Loading
        const logoutForm = document.getElementById('logout_form');
        const btnLogout = document.getElementById('btn_logout');
        const spinner = document.getElementById('spinner');
        const textLogout = document.getElementById('text_logout');

        logoutForm.addEventListener('submit', function() {
            btnLogout.disabled = true;
            btnLogout.classList.add('opacity-70', 'cursor-not-allowed');
            closeModalBtn.classList.add('invisible');
            spinner.classList.remove('hidden');
            textLogout.innerText = 'Tunggu...';
        });
    </script>
</section>