<div
    class="openModalPengembalian hidden fixed inset-0 bg-[#0F172A]/50 backdrop-blur-sm flex justify-center items-center z-50 p-4 transition-all">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl overflow-hidden border border-slate-100">

        {{-- Header --}}
        <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
            <div>
                <h2 class="text-base font-semibold text-indigo-950">Pengembalian Buku</h2>
                <p class="text-xs text-slate-400 mt-0.5">Konfirmasi pengembalian buku</p>
            </div>
            <button type="button"
                class="btnCloseModal w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </div>

        <form class="all_form form_denda grid grid-cols-2 divide-x divide-slate-100" method="POST">
            @csrf
            <input type="hidden" name="jumlah_denda" class="inputJumlahDendaHidden">
            <input type="hidden" name="total_bayar" class="inputTotalBayarHidden">
            <input type="hidden" name="jumlah_kembalian" class="inputKembalianHidden">
            <input type="hidden" name="jumlah_bayar" class="inputJumlahBayarReal">
            <input type="hidden" name="is_rusak" value="0" class="inputIsRusak">
            <input type="hidden" name="is_hilang" value="0" class="inputIsHilang">

            <div class="p-5 flex flex-col gap-4">

                {{-- Info Buku --}}
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
                            <span class="text-slate-400">Pinjam:
                                <span class="textTglPinjam font-medium text-slate-700"></span>
                            </span>
                            <div class="flex items-center gap-2">
                                <span class="text-slate-400">Tempo:
                                    <span class="textTglTempo font-medium text-red-600"></span>
                                </span>
                                <span
                                    class="textHariTerlambat bg-red-50 text-red-600 font-semibold px-2.5 py-0.5 rounded-full text-[10px]"></span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Denda & Telat --}}
                <div class="grid grid-cols-2 gap-3">
                    <div class="border border-slate-200 rounded-xl p-3">
                        <p class="text-[10px] text-slate-400 mb-1">Denda / hari</p>
                        <p class="text-sm font-semibold text-slate-700">Rp 4.000</p>
                        <input value="4000" type="number" readonly class="inputDenda hidden">
                    </div>
                    <div class="border border-slate-200 rounded-xl p-3">
                        <p class="text-[10px] text-slate-400 mb-1">Total telat</p>
                        <div class="flex items-center gap-1.5">
                            <input type="number" value="0" min="0" required
                                class="inputTotalTelat w-12 text-sm font-semibold text-indigo-700 outline-none bg-transparent">
                            <span class="text-[10px] text-slate-400">hari</span>
                        </div>
                    </div>
                </div>

                {{-- Kondisi Buku --}}
                <div class="border border-slate-200 rounded-xl overflow-hidden flex-1">
                    <div class="px-4 py-2.5 bg-slate-50 border-b border-slate-100">
                        <p class="text-[10px] font-semibold text-slate-500 uppercase tracking-wider">Kondisi buku</p>
                    </div>
                    <div class="p-3 flex flex-col gap-2.5">

                        {{-- Buku Rusak --}}
                        <div id="cardRusak"
                            class="border border-slate-200 rounded-xl overflow-hidden transition-colors duration-200">
                            <div class="flex items-center justify-between px-3 py-2.5 cursor-pointer kondisiToggleHeader"
                                data-target="rusak">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-red-500" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-700">Buku rusak</p>
                                        <p class="text-[10px] text-slate-400">Tambah biaya kerusakan</p>
                                    </div>
                                </div>
                                <div class="kondisiToggleTrack relative w-10 h-6 rounded-full bg-slate-200 transition-colors duration-200 cursor-pointer flex-shrink-0"
                                    data-target="rusak">
                                    <div
                                        class="kondisiToggleThumb absolute top-1 left-1 w-4 h-4 rounded-full bg-white shadow transition-transform duration-200">
                                    </div>
                                </div>
                            </div>
                            <div id="panelRusak" class="hidden px-3 pb-3">
                                <div class="border-t border-slate-100 pt-3">
                                    <label class="block text-[10px] text-slate-400 mb-1">Biaya kerusakan (Rp)</label>
                                    <input type="number" placeholder="Rp. xxxx" min="0" name="buku_rusak"
                                        class="inputRusak w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-indigo-300 focus:ring-1 focus:ring-indigo-100 transition">
                                </div>
                            </div>
                        </div>

                        {{-- Buku Hilang --}}
                        <div id="cardHilang"
                            class="border border-slate-200 rounded-xl overflow-hidden transition-colors duration-200">
                            <div class="flex items-center justify-between px-3 py-2.5 cursor-pointer kondisiToggleHeader"
                                data-target="hilang">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-amber-500" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-700">Buku hilang</p>
                                        <p class="text-[10px] text-slate-400">Tambah harga penggantian</p>
                                    </div>
                                </div>
                                <div class="kondisiToggleTrack relative w-10 h-6 rounded-full bg-slate-200 transition-colors duration-200 cursor-pointer flex-shrink-0"
                                    data-target="hilang">
                                    <div
                                        class="kondisiToggleThumb absolute top-1 left-1 w-4 h-4 rounded-full bg-white shadow transition-transform duration-200">
                                    </div>
                                </div>
                            </div>
                            <div id="panelHilang" class="hidden px-3 pb-3">
                                <div class="border-t border-slate-100 pt-3">
                                    <label class="block text-[10px] text-slate-400 mb-1">Harga penggantian
                                        (Rp)</label>
                                    <input type="number" placeholder="Rp. xxxx" min="0" name="buku_hilang"
                                        class="inputHilang w-full border border-slate-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-indigo-300 focus:ring-1 focus:ring-indigo-100 transition">
                                </div>
                            </div>
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

                {{-- Bayar Nanti --}}
                <div
                    class="flex items-center justify-between border border-dashed border-slate-200 rounded-xl px-4 py-3">
                    <div>
                        <p class="text-sm font-medium text-slate-700">Bayar nanti</p>
                        <p class="text-[10px] text-slate-400">Simpan sebagai hutang denda</p>
                    </div>
                    <div id="trackBayarNanti"
                        class="relative w-10 h-6 rounded-full bg-slate-200 transition-colors duration-200 cursor-pointer flex-shrink-0">
                        <div id="thumbBayarNanti"
                            class="absolute top-1 left-1 w-4 h-4 rounded-full bg-white shadow transition-transform duration-200">
                        </div>
                        <input type="checkbox" name="bayar_nanti" class="inputBayarNanti hidden">
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
                        <span class="text_simpan">Simpan konfirmasi</span>
                    </button>
                    <button type="button"
                        class="btnCloseModal w-full py-2.5 text-sm font-medium text-slate-500 hover:bg-slate-50 rounded-xl border border-slate-200 transition">
                        Batal
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
    // Modal Pengembalian
    const modalKembalikan = document.querySelector('.openModalPengembalian');
    const formDenda = document.querySelector('.form_denda');
    const btnSimpan = document.querySelector('.btn_simpan_perubahan');
    const btnHitung = document.querySelectorAll('.btnOpenModalKembalikan');
    const btnCloseModals = document.querySelectorAll('.btnCloseModal');

    const textBuku = document.querySelector('.textBuku');
    const textAnggota = document.querySelector('.textAnggota');
    const textTglPinjam = document.querySelector('.textTglPinjam');
    const textTglTempo = document.querySelector('.textTglTempo');
    const textHariTerlambat = document.querySelector('.textHariTerlambat');
    const textTotalDenda = document.querySelector('.textTotalDenda');
    const textKembalian = document.querySelector('.textKembalian');

    const inputDenda = document.querySelector('.inputDenda');
    const inputTotalTelat = document.querySelector('.inputTotalTelat');
    const inputJumlahBayar = document.querySelector('.inputJumlahBayar');
    const inputJumlahBayarReal = document.querySelector('.inputJumlahBayarReal');

    const inputJumlahDendaHidden = document.querySelector('.inputJumlahDendaHidden');
    const inputTotalBayarHidden = document.querySelector('.inputTotalBayarHidden');
    const inputKembalianHidden = document.querySelector('.inputKembalianHidden');

    const inputRusak = document.querySelector('.inputRusak');
    const inputHilang = document.querySelector('.inputHilang');

    const cardRusak = document.getElementById('cardRusak');
    const cardHilang = document.getElementById('cardHilang');
    const panelRusak = document.getElementById('panelRusak');
    const panelHilang = document.getElementById('panelHilang');

    const trackBayarNanti = document.getElementById('trackBayarNanti');
    const thumbBayarNanti = document.getElementById('thumbBayarNanti');
    const inputBayarNanti = document.querySelector('.inputBayarNanti');

    const inputIsRusak = document.querySelector('.inputIsRusak');
    const inputIsHilang = document.querySelector('.inputIsHilang');

    // STATE
    const state = {
        rusak: false,
        hilang: false,
        bayarNanti: false,
    };

    // FORMAT
    function formatRupiah(n) {
        return 'Rp ' + (Math.round(n) || 0).toLocaleString('id-ID');
    }

    // UI TOGGLE
    function setToggleUI(track, thumb, aktif) {
        if (aktif) {
            track.classList.replace('bg-slate-200', 'bg-[#35094D]');
            thumb.style.transform = 'translateX(16px)';
        } else {
            track.classList.replace('bg-[#35094D]', 'bg-slate-200');
            thumb.style.transform = 'translateX(0)';
        }
    }

    // HITUNG DENDA
    function hitungDenda() {
        const denda = parseInt(inputDenda.value) || 0;
        const telat = parseInt(inputTotalTelat.value) || 0;

        const rusak = state.rusak ? (parseInt(inputRusak.value) || 0) : 0;
        const hilang = state.hilang ? (parseInt(inputHilang.value) || 0) : 0;

        const total = denda * telat + rusak + hilang;

        if (total <= 0) {
            trackBayarNanti.style.pointerEvents = 'none';
            trackBayarNanti.classList.add('opacity-40');

            state.bayarNanti = false;
            inputBayarNanti.checked = false;

            setToggleUI(trackBayarNanti, thumbBayarNanti, false);
        } else {
            trackBayarNanti.style.pointerEvents = 'auto';
            trackBayarNanti.classList.remove('opacity-40');
        }

        textTotalDenda.textContent = formatRupiah(total);
        inputJumlahDendaHidden.value = total;

        hitungKembalian(total);
    }

    // HITUNG KEMBALIAN
    function hitungKembalian(totalDenda) {
        const bayar = parseInt(inputJumlahBayarReal.value) || 0;
        const kembalian = Math.max(bayar - totalDenda, 0);


        textKembalian.textContent = formatRupiah(kembalian);
        inputTotalBayarHidden.value = bayar;
        inputKembalianHidden.value = kembalian;

        let boleh = true;

        if (!state.bayarNanti) {
            if (bayar > 0) {
                boleh = bayar >= totalDenda;
            }
        }

        btnSimpan.disabled = !boleh;
        btnSimpan.classList.toggle('opacity-50', !boleh);
        btnSimpan.classList.toggle('cursor-not-allowed', !boleh);
    }

    // TOGGLE KONDISI
    function toggleKondisi(type) {
        state[type] = !state[type];
        const aktif = state[type];

        if (type === 'rusak') {
            inputIsRusak.value = aktif ? 1 : 0;
        }
        if (type === 'hilang') {
            inputIsHilang.value = aktif ? 1 : 0;
        }

        const card = type === 'rusak' ? cardRusak : cardHilang;
        const panel = type === 'rusak' ? panelRusak : panelHilang;
        const input = type === 'rusak' ? inputRusak : inputHilang;

        const track = card.querySelector('.kondisiToggleTrack');
        const thumb = card.querySelector('.kondisiToggleThumb');

        setToggleUI(track, thumb, aktif);

        if (aktif) {
            panel.classList.remove('hidden');
            input.disabled = false;
        } else {
            panel.classList.add('hidden');
            input.value = '';
            input.disabled = true;
        }

        hitungDenda();
    }

    // EVENT TOGGLE
    document.querySelectorAll('.kondisiToggleHeader, .kondisiToggleTrack').forEach(el => {
        el.addEventListener('click', function() {
            const type = this.dataset.target;
            toggleKondisi(type);
        });
    });

    // BAYAR NANTI
    trackBayarNanti.addEventListener('click', function() {
        state.bayarNanti = !state.bayarNanti;
        inputBayarNanti.checked = state.bayarNanti;

        setToggleUI(trackBayarNanti, thumbBayarNanti, state.bayarNanti);

        if (state.bayarNanti) {
            inputJumlahBayar.disabled = true;
            inputJumlahBayar.value = '';
            inputJumlahBayarReal.value = 0;
            textKembalian.textContent = 'Rp 0';

            btnSimpan.disabled = false;
            btnSimpan.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            inputJumlahBayar.disabled = false;
        }
    });

    // INPUT BAYAR
    inputJumlahBayar.addEventListener('input', function() {
        const angka = this.value.replace(/\D/g, '');
        this.value = angka ? parseInt(angka).toLocaleString('id-ID') : '';
        inputJumlahBayarReal.value = angka || 0;
        hitungDenda();
    });

    // INPUT EVENT
    inputTotalTelat.addEventListener('input', hitungDenda);
    inputRusak.addEventListener('input', hitungDenda);
    inputHilang.addEventListener('input', hitungDenda);

    // OPEN MODAL
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
            textHariTerlambat.textContent = `Terlambat ${telat} hari`;

            inputTotalTelat.value = telat;

            // RESET STATE 
            state.rusak = false;
            state.hilang = false;
            state.bayarNanti = false;

            // reset input kondisi
            inputRusak.value = '';
            inputHilang.value = '';
            inputRusak.disabled = true;
            inputHilang.disabled = true;

            panelRusak.classList.add('hidden');
            panelHilang.classList.add('hidden');

            // reset bayar
            inputJumlahBayar.value = '';
            inputJumlahBayarReal.value = 0;
            inputJumlahBayar.disabled = false;

            // reset toggle UI
            setToggleUI(cardRusak.querySelector('.kondisiToggleTrack'), cardRusak.querySelector(
                '.kondisiToggleThumb'), false);
            setToggleUI(cardHilang.querySelector('.kondisiToggleTrack'), cardHilang.querySelector(
                '.kondisiToggleThumb'), false);
            setToggleUI(trackBayarNanti, thumbBayarNanti, false);

            inputBayarNanti.checked = false;

            formDenda.action = `/pengembalian/${id}`;

            modalKembalikan.classList.remove('hidden');

            hitungDenda();
        });
    });

    // CLOSE MODAL
    btnCloseModals.forEach(btn => {
        btn.addEventListener('click', () => {
            modalKembalikan.classList.add('hidden');
        });
    });
</script>
