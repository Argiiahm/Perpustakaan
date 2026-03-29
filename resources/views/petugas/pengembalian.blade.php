@extends('layouts.index')

@section('halaman', 'Daftar pengembalian')

@section('main')


    {{-- Filter --}}
    <section class="mt-20 flex justify-end">
        {{-- Searching --}}
        <form action="/pengembalian" method="GET" class="form-cari flex items-center gap-2">
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
                <h2 class="text-2xl text-gray-500 font-medium">Daftar pengembalian - Pending</h2>
                <p class="text-sm text-gray-400">Konfirmasi pengembalian dan hitung total denda jika ada.</p>
            </div>
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b border-gray-200">
                        <th class="pb-4 text-center text-gray-400 font-normal">Kode Buku</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Nik/Nis</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tgl Pinjam</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tgl Tempo</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Tgl Pengembalian</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Detail</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Status Pengembalian</th>
                        <th class="pb-4 text-center text-gray-400 font-normal">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-[#35094D]">
                    @forelse ($pengembalians as $pengembalian)
                        @php
                            $isTerlambat = \Carbon\Carbon::parse($pengembalian->tanggal_kembalian)->gt(
                                \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal_jatuh_tempo),
                            );
                        @endphp
                        <tr class="border-b border-gray-200">
                            <td class="py-4 text-center">{{ $pengembalian->peminjaman->buku->kode_buku ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $pengembalian->peminjaman->anggota->nomer_induk ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $pengembalian->peminjaman->tanggal_pinjam ?? 'N/A' }}</td>
                            <td class="py-4 text-center">{{ $pengembalian->peminjaman->tanggal_jatuh_tempo ?? 'N/A' }}</td>
                            @if ($isTerlambat)
                                <td class="py-4 text-center text-red-500 font-medium">Terlambat -
                                    {{ $pengembalian->tanggal_kembalikan ?? 'N/A' }}</td>
                            @else
                                <td class="py-4 text-center">
                                    {{ $pengembalian->tanggal_kembalikan ?? 'N/A' }}</td>
                            @endif
                            <td class="py-4 flex justify-center">
                                <button class="openModalDetailPengembalian flex justify-center cursor-pointer"
                                    data-id="{{ $pengembalian->peminjaman->id }}"
                                    data-nomer_induk="{{ $pengembalian->peminjaman->anggota->nomer_induk }}"
                                    data-nama="{{ $pengembalian->peminjaman->anggota->nama_lengkap }}"
                                    data-jk="{{ $pengembalian->peminjaman->anggota->jenis_kelamin }}"
                                    data-alamat="{{ $pengembalian->peminjaman->anggota->alamat }}"
                                    data-tgl_pinjam="{{ $pengembalian->peminjaman->tanggal_pinjam }}"
                                    data-tgl_tempo="{{ $pengembalian->peminjaman->tanggal_jatuh_tempo }}"
                                    data-tgl_kembalikan="{{ $pengembalian->tanggal_kembalikan }}"
                                    data-total_hari_telat="{{ $pengembalian->total_hari_terlambat }}"
                                    data-status_pinjaman="{{ $pengembalian->peminjaman->status }}"
                                    data-status_kembalikan="{{ $pengembalian->status }}"
                                    data-kode_buku="{{ $pengembalian->peminjaman->buku->kode_buku }}"
                                    data-judul_buku="{{ $pengembalian->peminjaman->buku->judul_buku }}"
                                    data-penulis="{{ $pengembalian->peminjaman->buku->penulis }}"
                                    data-thn_terbit="{{ $pengembalian->peminjaman->buku->tahun_terbit }}" type="button">

                                    <img src="{{ asset('icons/svg/detail.svg') }}" alt="">
                                </button>
                            </td>
                            <td class="py-4 text-center">
                                <span class="bg-[#F99D22] text-white px-6 py-2 rounded-full">
                                    {{ $pengembalian->status ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="py-4 text-center">
                                @if ($isTerlambat)
                                    <button type="button"
                                        class="btnHitungDenda bg-red-500 text-white px-6 py-2 rounded-full"
                                        data-id="{{ $pengembalian->id }}"
                                        data-judul="{{ $pengembalian->peminjaman->buku->judul_buku }}"
                                        data-kode="{{ $pengembalian->peminjaman->buku->kode_buku }}"
                                        data-nama="{{ $pengembalian->peminjaman->anggota->nama_lengkap }}"
                                        data-nis="{{ $pengembalian->peminjaman->anggota->nomer_induk }}"
                                        data-pinjam="{{ $pengembalian->peminjaman->tanggal_pinjam }}"
                                        data-tempo="{{ $pengembalian->peminjaman->tanggal_jatuh_tempo }}"
                                        data-telat="{{ $pengembalian->total_hari_terlambat }}">
                                        Hitung Denda
                                    </button>
                                @else
                                    <button type="button" data-id="{{ $pengembalian->id }}"
                                        class="openModalPengembalian bg-[#35094D] cursor-pointer text-white px-6 py-2 rounded-full">
                                        Konfirmasi
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-gray-500">Tidak ada Data yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-5">
                {{ $pengembalians->links() }}
            </div>
        </div>
    </section>

    {{-- Detail Pengembalian Modal --}}
    @include('components.modal-detail-pengembalian')

    {{-- Modal Pengembalian --}}
    <section
        class="open_modal_pengembalian hidden fixed inset-0 bg-[#0F172A]/60 backdrop-blur-md flex justify-center items-center z-50 p-4 transition-all">
        <div class="bg-white w-full max-w-md rounded-3xl  overflow-hidden transform transition-all scale-100">
            <div class="p-8 text-center">
                <div class="w-20 h-20 bg-[#35094D]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <img class="w-12" src="{{ asset('icons/svg/ajukan-jadwal.svg') }}" alt="">
                </div>
                <h2 class="text-[#35094D] text-2xl font-bold">Konfirmasi Pengembalian?</h2>
                <p class="text-gray-500 mb-8">silahkan konfirmasi pengembalian</p>

                <div class="flex flex-col gap-3">
                    <form class="all_form form_pengenbalian" action="" method="POST">
                        @csrf
                        <input type="hidden" name="" value="">
                        <button type="submit"
                            class="btn_simpan_perubahan w-full bg-[#35094D] text-white font-bold py-4 rounded-xl transition-all flex items-center justify-center gap-2">
                            <svg id="" class="spinner_load hidden animate-spin h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span class="text_simpan">Ya, Konfirmasi</span>
                        </button>
                    </form>
                    <button
                        class="btn_close_pengembalian w-full border-2 border-gray-100 text-gray-400 font-bold py-4 rounded-xl hover:bg-gray-50 transition-all">
                        Batalkan
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Hitung Denda --}}
    <div
        class="modalHitungDenda hidden fixed inset-0 bg-[#0F172A]/50 backdrop-blur-sm flex justify-center items-center z-50 p-4 transition-all">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden border border-slate-100">

            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
                <h2 class="text-lg font-bold text-indigo-950">Hitung Denda</h2>
            </div>

            <form class="form_denda p-6 space-y-4" method="POST">
                @csrf
                <input type="hidden" name="jumlah_denda" class="inputJumlahDendaHidden">
                <input type="hidden" name="total_bayar" class="inputTotalBayarHidden">
                <input type="hidden" name="jumlah_kembalian" class="inputKembalianHidden">
                <input type="hidden" name="jumlah_bayar" class="inputJumlahBayarReal">

                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                    <div class="grid grid-cols-2 gap-y-2 text-xs">
                        <div>
                            <p class="text-slate-500">Judul Buku</p>
                            <p class="textBuku font-bold text-indigo-900">Matahari (BOOK3301)</p>
                        </div>
                        <div>
                            <p class="text-slate-500">Peminjam</p>
                            <p class="textAnggota font-bold text-indigo-900">Argi Ahes (2200121)</p>
                        </div>
                        <div class="col-span-2 mt-2 pt-2 border-t border-slate-200/60 flex justify-between">
                            <div class="flex items-center gap-2">
                                <span class="text-slate-400">Pinjam:</span>
                                <span class="textTglPinjam font-semibold text-slate-700">20/01/26</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-red-400">Tempo:</span>
                                <span class="textTglTempo font-semibold text-red-600">26/01/26</span>
                                <span
                                    class="textHariTerlambat px-3 py-1 bg-red-50 text-red-600 text-xs font-bold rounded-full">Terlambat
                                    2 Hari</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Rincian Pembayaran</h3>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="p-3 bg-white border border-slate-200 rounded-lg">
                            <label class="block text-[10px] text-slate-500 mb-1">Denda/Hari</label>
                            <input value="4000" type="number" readonly
                                class="inputDenda font-bold text-slate-700 outline-0">
                        </div>
                        <div class="p-3 bg-white border border-slate-200 rounded-lg">
                            <label class="block text-[10px] text-slate-500 mb-1">Input Total Telat</label>
                            <div class="flex items-center gap-1">
                                <input type="number" value="0" required
                                    class="inputTotalTelat w-10 font-bold text-indigo-600 outline-none">
                                <span class="text-[10px] text-slate-400 font-medium">Hari</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 bg-indigo-50/50 border border-indigo-100 rounded-xl">
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-sm text-slate-600 font-medium">Total Denda</span>
                            <span class="textTotalDenda text-lg font-black text-indigo-900">Rp 8.000</span>
                        </div>

                        <div class="space-y-2 pt-3 border-t border-indigo-200/50">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-500">Jumlah Bayar (Rp)</span>
                                <input type="text" value="" required
                                    class="inputJumlahBayar w-24 text-right font-bold text-slate-700 bg-white border border-slate-200 rounded px-2 py-1 outline-none focus:border-indigo-400">
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-500">Kembalian</span>
                                <span class="textKembalian font-bold text-green-600">Rp 2.000</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex gap-2 pt-2">
                    <button type="button"
                        class="btnCloseDenda flex-1 py-2.5 text-sm font-bold text-slate-500 hover:bg-slate-50 rounded-xl transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-[2] py-2.5 bg-indigo-950 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-200 hover:bg-black transition">
                        Simpan Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal Pengembalian
        const openModalPengembalian = document.querySelectorAll('.openModalPengembalian');
        const modalkonfirmasiPengembalian = document.querySelector('.open_modal_pengembalian');
        const formPengembalian = document.querySelector('.form_pengenbalian');
        const closeModalPengembalian = document.querySelector('.btn_close_pengembalian');

        openModalPengembalian.forEach(btn => {
            btn.addEventListener("click", function() {
                const id = this.dataset.id;
                modalkonfirmasiPengembalian.classList.remove('hidden');
                formPengembalian.action = `/pengembalian/${id}`;
            });
        });

        closeModalPengembalian.addEventListener("click", function() {
            modalkonfirmasiPengembalian.classList.add('hidden');
        });

        // Hitung Denda
        const btnHitung = document.querySelectorAll('.btnHitungDenda');
        const modalDenda = document.querySelector('.modalHitungDenda');
        const formDenda = document.querySelector('.form_denda');

        const textBuku = document.querySelector('.textBuku');
        const textAnggota = document.querySelector('.textAnggota');
        const textTglPinjam = document.querySelector('.textTglPinjam');
        const textTglTempo = document.querySelector('.textTglTempo');
        const textHariTerlambat = document.querySelector('.textHariTerlambat');

        const inputDenda = document.querySelector('.inputDenda');
        const inputTotalTelat = document.querySelector('.inputTotalTelat');
        const textTotalDenda = document.querySelector('.textTotalDenda');

        const inputJumlahBayar = document.querySelector('.inputJumlahBayar'); // tampilan
        const inputJumlahBayarReal = document.querySelector('.inputJumlahBayarReal'); // real value

        const textKembalian = document.querySelector('.textKembalian');

        const inputJumlahDendaHidden = document.querySelector('.inputJumlahDendaHidden');
        const inputTotalBayarHidden = document.querySelector('.inputTotalBayarHidden');
        const inputKembalianHidden = document.querySelector('.inputKembalianHidden');

        function formatRupiah(angka) {
            return 'Rp ' + (angka || 0).toLocaleString('id-ID');
        }

        function hitungDenda() {
            const denda = parseInt(inputDenda.value) || 0;
            const telat = parseInt(inputTotalTelat.value) || 0;

            const total = denda * telat;

            textTotalDenda.textContent = formatRupiah(total);
            inputJumlahDendaHidden.value = total;

            hitungKembalian(total);
        }


        function hitungKembalian(totalDenda) {
            let bayar = inputJumlahBayarReal.value || 0;
            bayar = parseInt(bayar) || 0;

            const kembalian = bayar - totalDenda;
            const fix = kembalian > 0 ? kembalian : 0;

            textKembalian.textContent = formatRupiah(fix);

            inputTotalBayarHidden.value = bayar;
            inputKembalianHidden.value = fix;
        }

        inputTotalTelat.addEventListener('input', hitungDenda);

        inputJumlahBayar.addEventListener('input', function() {
            let angka = this.value.replace(/\D/g, '');

            this.value = angka ? parseInt(angka).toLocaleString('id-ID') : '';

            inputJumlahBayarReal.value = angka;

            const total = (parseInt(inputDenda.value) || 0) * (parseInt(inputTotalTelat.value) || 0);
            hitungKembalian(total);
        });


        btnHitung.forEach(btn => {
            btn.addEventListener('click', function() {

                const id = this.dataset.id;
                const judul = this.dataset.judul;
                const kode = this.dataset.kode;
                const nama = this.dataset.nama;
                const nis = this.dataset.nis;
                const pinjam = this.dataset.pinjam;
                const tempo = this.dataset.tempo;
                const telat = Math.ceil(parseFloat(this.dataset.telat)) || 0;

                textBuku.textContent = `${judul} (${kode})`;
                textAnggota.textContent = `${nama} (${nis})`;
                textTglPinjam.textContent = pinjam;
                textTglTempo.textContent = tempo;
                textHariTerlambat.textContent = `Terlambat ${telat} Hari`;

                inputTotalTelat.value = telat;

                // reset input
                inputJumlahBayar.value = '';
                inputJumlahBayarReal.value = 0;

                modalDenda.classList.remove('hidden');
                formDenda.action = `/pengembalian/${id}`;

                hitungDenda();
            });
        });

        const btnCloseDenda = document.querySelector('.modalHitungDenda .btnCloseDenda');

        if (btnCloseDenda) {
            btnCloseDenda.addEventListener('click', () => {
                modalDenda.classList.add('hidden');
            });
        }
    </script>

@endsection
