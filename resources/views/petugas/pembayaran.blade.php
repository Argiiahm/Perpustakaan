@extends('layouts.index')

@section('halaman', 'Daftar Pembayaran')

@section('main')


    {{-- Filter --}}
    <section class="mt-20 flex justify-end">
        {{-- Searching --}}
        <form action="/pembayaran" method="GET" class="form-cari flex items-center gap-2">
            <div class="relative w-full max-w-[450px]">
                <div class="absolute inset-y-0 left-4 flex items-center">
                    <img src="{{ asset('icons/svg/Search.svg') }}" alt="">
                </div>
                <input name="cari" type="text" placeholder="Cari nis/nik, nama...."
                    class="bg-white w-full pl-12 pr-4 py-3 rounded-md placeholder:text-gray-300 border border-gray-200"
                    value="{{ request('cari') }}">
            </div>
            <button type="submit"
                class="bg-[#35094D] text-white px-6 py-3 rounded-md hover:bg-[#2a073a] transition duration-300 cursor-pointer">Cari</button>
        </form>
    </section>

    <section class="">
        <div class="bg-white w-full rounded-xl mt-4 p-6">
            <div class="mb-10">
                <h2 class="text-2xl text-gray-500 font-medium">Daftar pembayaran - tertunda</h2>
                <p class="text-sm text-gray-400">Konfirmasi pembayaran.</p>
            </div>
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-gray-200">
                        <th class="pb-4 text-center text-gray-400 font-normal">Nik/Nis</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Nama Lengkap</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tgl Pengembalian</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Buku Rusak</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Buku Hilang</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Total Denda</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Status Pembayaran</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[#35094D]">
                    @forelse ($pengembalians as $pengembalian)
                        <tr class="border-b border-gray-200">
                            <td class="py-4 text-center">{{ $pengembalian->peminjaman->anggota->nomer_induk ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $pengembalian->peminjaman->anggota->nama_lengkap ?? 'N/A' }}
                            </td>
                            <td class="py-4 text-center">{{ $pengembalian->tanggal_kembalikan ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $pengembalian->buku_rusak ? 'Ya' : 'Tidak' }}</td>
                            <td class="py-4 text-center">{{ $pengembalian->buku_hilang ? 'Ya' : 'Tidak' }}</td>
                            <td class="py-4 text-center">Rp {{ number_format($pengembalian->jumlah_denda, 0, ',', '.') }}
                            </td>
                            <td class="py-4 text-center">
                                @if ($pengembalian->status_pembayaran == 'lunas')
                                    <span class="text-green-500 font-medium">Lunas</span>
                                @else
                                    <span class="text-red-500 font-medium">Tertunda</span>
                                @endif
                            </td>
                            <td class="py-4 flex justify-center">
                                <button data-id="{{ $pengembalian->id }}"
                                    data-buku="{{ $pengembalian->peminjaman->buku->judul_buku ?? 'N/A' }}"
                                    data-anggota="{{ $pengembalian->peminjaman->anggota->nama_lengkap ?? 'N/A' }}"
                                    data-tgl-pinjam="{{ $pengembalian->peminjaman->tanggal_pinjam ?? 'N/A' }}"
                                    data-total-denda="Rp {{ number_format($pengembalian->jumlah_denda, 0, ',', '.') }}"
                                    class="btnOpenModalBayar bg-[#35094D] cursor-pointer text-white px-4 py-2 rounded-md hover:bg-[#2a073a] transition duration-300">Proses</button>
                            </td>
                        @empty
                        <tr>
                            <td colspan="9" class="py-4 text-center text-gray-400">Tidak ada data pembayaran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-5">
                {{ $pengembalians->links() }}
            </div>
        </div>
    </section>

    <div
        class="openModalPembayaran hidden fixed inset-0 bg-[#0F172A]/50 backdrop-blur-sm flex justify-center items-center z-50 p-4 transition-all">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl overflow-hidden border border-slate-100">

            {{-- Header --}}
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
                <div>
                    <h2 class="text-base font-semibold text-indigo-950">Pembayaran</h2>
                    <p class="text-xs text-slate-400 mt-0.5">Konfirmasi pembayaran denda</p>
                </div>
                <button type="button"
                    class="btnCloseModalPembayaran w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>

            <form class="all_form form_pembayaran grid grid-cols-2 divide-x divide-slate-100" method="POST">
                @csrf
                <input type="hidden" name="jumlah_denda" class="inputJumlahDendaHidden">
                <input type="hidden" name="total_bayar" class="inputTotalBayarHidden">
                <input type="hidden" name="jumlah_kembalian" class="inputKembalianHidden">
                <input type="hidden" name="jumlah_bayar" class="inputJumlahBayarReal">

                <div class="p-5 flex flex-col gap-4">
                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-4">
                        <div class="grid grid-cols-2 gap-y-3 text-xs">
                            <div>
                                <p class="text-slate-400 mb-0.5">Judul buku</p>
                                <p class="textBuku font-semibold text-indigo-900 text-sm"></p>
                            </div>
                            <div>
                                <p class="text-slate-400 mb-0.5">Peminjam</p>
                                <p class="textAnggota font-semibold text-indigo-900 text-sm"></p>
                            </div>
                            <div
                                class="col-span-2 pt-3 border-t border-slate-200 flex justify-between items-center flex-wrap gap-2">
                                <span class="text-slate-400">Tanggal Kembalikan :
                                    <span class="textTglPinjam font-medium text-slate-700"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-5 flex flex-col gap-4">

                    {{-- Rincian Pembayaran --}}
                    <div class="border border-slate-200 rounded-xl overflow-hidden flex-1">
                        <div class="px-4 py-2.5 bg-slate-50 border-b border-slate-100">
                            <p class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider">Rincian
                                pembayaran</p>
                        </div>
                        <div class="p-4 flex flex-col gap-4">
                            <div class="flex justify-between items-center pb-4 border-b border-slate-100">
                                <span class="text-sm text-slate-500">Total denda</span>
                                <span class="textTotalDenda text-xl font-bold text-indigo-900">Rp 0</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-slate-500">Jumlah bayar</span>
                                <input type="text" placeholder="Rp 0"
                                    class="inputJumlahBayar w-36 text-right text-sm font-semibold text-slate-700 bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 outline-none focus:border-indigo-300 transition">
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-slate-500">Kembalian</span>
                                <span class="textKembalian text-sm font-bold text-emerald-600">Rp 0</span>
                            </div>
                        </div>
                    </div>

                    {{-- Aksi --}}
                    <div class="flex flex-col gap-2 mt-auto">
                        <button type="submit"
                            class="btn_simpan_perubahan w-full bg-[#35094D] hover:bg-[#2a073a] text-white font-semibold py-3 rounded-xl transition flex items-center justify-center gap-2">
                            <svg class="spinner_load hidden animate-spin h-4 w-4 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4" />
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                            </svg>
                            <span class="text_simpan">Bayar</span>
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <script>
        const btnOpenModalBayar = document.querySelectorAll('.btnOpenModalBayar');
        const openModalPembayaran = document.querySelector('.openModalPembayaran');
        const formPembayaran = document.querySelector('.form_pembayaran');
        const btnCloseModal = document.querySelector('.btnCloseModalPembayaran');

        const textBuku = document.querySelector('.textBuku');
        const textAnggota = document.querySelector('.textAnggota');
        const textTglPinjam = document.querySelector('.textTglPinjam');
        const textTotalDenda = document.querySelector('.textTotalDenda');
        const textKembalian = document.querySelector('.textKembalian');

        const inputJumlahBayar = document.querySelector('.inputJumlahBayar');
        const inputTotalBayarHidden = document.querySelector('.inputTotalBayarHidden');
        const inputKembalianHidden = document.querySelector('.inputKembalianHidden');
        const inputJumlahBayarReal = document.querySelector('.inputJumlahBayarReal');
        const inputJumlahDendaHidden = document.querySelector('.inputJumlahDendaHidden');

        const btnSimpan = document.querySelector('.btn_simpan_perubahan');

        function formatRupiah(angka) {
            return 'Rp ' + angka.toLocaleString('id-ID');
        }

        btnOpenModalBayar.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const buku = this.dataset.buku;
                const anggota = this.dataset.anggota;
                const tglPinjam = this.dataset.tglPinjam;
                const totalDendaText = this.dataset.totalDenda;

                // set text
                textBuku.textContent = buku;
                textAnggota.textContent = anggota;
                textTglPinjam.textContent = tglPinjam;
                textTotalDenda.textContent = totalDendaText;

                // ambil angka
                const totalAngka = parseInt(totalDendaText.replace(/[^0-9]/g, '')) || 0;

                // set hidden
                inputJumlahDendaHidden.value = totalAngka;

                // reset input
                inputJumlahBayar.value = '';
                textKembalian.textContent = 'Rp 0';

                // reset tombol
                btnSimpan.disabled = true;
                btnSimpan.classList.add('opacity-50', 'cursor-not-allowed');

                // set action form
                formPembayaran.action = `/pembayaran/${id}`;

                openModalPembayaran.classList.remove('hidden');
            });
        });

        btnCloseModal.addEventListener('click', () => {
            openModalPembayaran.classList.add('hidden');
        });

        function hitungKembalian() {
            const total = parseInt(textTotalDenda.textContent.replace(/[^0-9]/g, '')) || 0;
            const bayar = parseInt(inputJumlahBayar.value.replace(/[^0-9]/g, '')) || 0;

            const kembalian = Math.max(bayar - total, 0);

            // tampilkan
            textKembalian.textContent = formatRupiah(kembalian);

            // simpan ke hidden
            inputTotalBayarHidden.value = bayar;
            inputKembalianHidden.value = kembalian;
            inputJumlahBayarReal.value = bayar;

            // validasi tombol
            let boleh = bayar > 0 && bayar >= total;

            btnSimpan.disabled = !boleh;
            btnSimpan.classList.toggle('opacity-50', !boleh);
            btnSimpan.classList.toggle('cursor-not-allowed', !boleh);
        }


        inputJumlahBayar.addEventListener('input', () => {
            hitungKembalian();
        });


        formPembayaran.addEventListener('submit', function(e) {
            const total = parseInt(textTotalDenda.textContent.replace(/[^0-9]/g, '')) || 0;
            const bayar = parseInt(inputJumlahBayar.value.replace(/[^0-9]/g, '')) || 0;

            const kembalian = Math.max(bayar - total, 0);

            inputJumlahBayarReal.value = bayar;
            inputTotalBayarHidden.value = bayar;
            inputKembalianHidden.value = kembalian;
        });
    </script>
@endsection
