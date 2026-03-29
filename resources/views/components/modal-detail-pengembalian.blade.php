 {{-- Modal Detail --}}
 <section
     class="modal_detail_Pengembalian hidden fixed inset-0 bg-gray-900/50 backdrop-blur-sm flex items-center justify-center p-4 z-50">
     <div
         class="bg-white w-full max-w-4xl rounded-2xl shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-300">

         <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-purple-50/50">
             <h2 class="text-2xl font-bold text-[#35094D]">Detail Pengembalian</h2>
             <button class="closeModalPengembalian text-gray-400 hover:text-red-500 cursor-pointer">
                 Close
             </button>
         </div>

         <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">

             <div class="space-y-6">
                 <div class="mb-4">
                     <h3 class="font-semibold text-gray-400 uppercase tracking-wider text-sm">Informasi Anggota</h3>
                 </div>

                 <div class="grid gap-4">
                     <div>
                         <label class="block text-xs font-bold text-gray-500 uppercase mb-1">NIS / NIK</label>
                         <input type="text" readonly value=""
                             class="nomer_induk w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 text-gray-700 focus:ring-2 focus:ring-purple-500 outline-none transition-all">
                     </div>
                     <div>
                         <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama Anggota</label>
                         <input type="text" readonly value=""
                             class="nama_lengkap w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 text-gray-700 outline-none">
                     </div>
                     <div>
                         <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Jenis Kelamin</label>
                         <input type="text" readonly value=""
                             class="jenis_kelamin w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 text-gray-700 outline-none">
                     </div>
                     <div>
                         <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Alamat</label>
                         <textarea readonly
                             class="alamat w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 text-gray-700 outline-none h-24 resize-none">-</textarea>
                     </div>
                 </div>
             </div>

             <div class="space-y-6">
                 <div class="mb-2">
                     <h3 class="font-semibold text-gray-400 uppercase tracking-wider text-sm">Detail Pengembalian</h3>
                 </div>

                 <div class="bg-gray-50 p-5 rounded-xl border border-gray-100 space-y-4">
                     <div class="grid grid-cols-2 gap-4">
                         <div>
                             <label class="block text-[10px] font-bold text-[#35094D] uppercase mb-1">Tanggal
                                 Pinjam</label>
                             <div class="relative">
                                 <input type="text" readonly value=""
                                     class="tgl_pinjam w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700">
                             </div>
                         </div>
                         <div>
                             <label class="block text-[10px] font-bold text-red-600 uppercase mb-1">Jatuh Tempo</label>
                             <input type="text" readonly value=""
                                 class="tgl_tempo w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700 font-semibold">
                         </div>
                         <div>
                             <label class="block text-[10px] font-bold text-red-600 uppercase mb-1">Tanggal
                                 Kembalikan</label>
                             <input type="text" readonly value=""
                                 class="tgl_kembalikan w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700 font-semibold">
                         </div>
                         <div>
                             <label class="block text-[10px] font-bold text-red-600 uppercase mb-1">Total Hari
                                 Terlambat</label>
                             <input type="text" readonly value=""
                                 class="total_hari_terlambat w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700 font-semibold">
                         </div>
                     </div>
                     <div class="flex gap-8 items-center">
                         <div>
                             <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Status
                                 Pinjaman</label>
                             <span
                                 class="status_pinjaman inline-flex items-center px-3 py-1 rounded-full text-xs font-medium">
                                 -
                             </span>
                         </div>
                         <div>
                             <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Status
                                 Kembalian</label>
                             <span
                                 class="status_pengembalian inline-flex items-center px-3 py-1 rounded-full text-xs font-medium">
                                 -
                             </span>
                         </div>
                     </div>
                 </div>

                 <div class="space-y-4">
                     <div class="grid grid-cols-3 gap-4">
                         <div class="col-span-1">
                             <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Kode</label>
                             <input type="text" readonly value=""
                                 class="kode_buku w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700">
                         </div>
                         <div class="col-span-2">
                             <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Judul Buku</label>
                             <input type="text" readonly value=""
                                 class="judul_buku w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700 font-bold">
                         </div>
                     </div>
                     <div class="grid grid-cols-2 gap-4">
                         <div>
                             <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Penulis</label>
                             <input type="text" readonly value=""
                                 class="penulis w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700">
                         </div>
                         <div>
                             <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tahun Terbit</label>
                             <input type="text" readonly value=""
                                 class="thn_terbit w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700">
                         </div>
                     </div>
                 </div>

                 <div class="space-y-4 pt-4 border-t border-gray-200">
                     <div class="mb-2">
                         <h3 class="font-semibold text-gray-400 uppercase tracking-wider text-sm">Rincian Pembayaran Denda</h3>
                     </div>
                     <div class="grid grid-cols-2 gap-4">
                         <div>
                             <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Total Denda</label>
                             <input type="text" readonly value=""
                                 class="jumlah_denda w-full bg-red-50 border border-red-100 rounded-lg px-3 py-2 text-sm text-red-600 font-bold">
                         </div>
                         <div>
                             <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Jumlah Bayar (Tunai)</label>
                             <input type="text" readonly value=""
                                 class="jumlah_bayar w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700 font-bold">
                         </div>
                         <div>
                             <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Kembalian</label>
                             <input type="text" readonly value=""
                                 class="jumlah_kembalian w-full bg-green-50 border border-green-100 rounded-lg px-3 py-2 text-sm text-green-600 font-bold">
                         </div>
                         <div>
                             <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Total Denda Bayar</label>
                             <input type="text" readonly value=""
                                 class="total_bayar w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm text-gray-700 font-bold">
                         </div>
                     </div>
                 </div>

             </div>
         </div>
     </div>
 </section>

 <script>
     // Modal Detail Pengembalian
     const btnOpenPengembalian = document.querySelectorAll('.openModalDetailPengembalian');
     const modalPengembalian = document.querySelector('.modal_detail_Pengembalian');
     
     if (modalPengembalian) {
         const btnClosePengembalian = modalPengembalian.querySelector('.closeModalPengembalian');

         const pengembalianNomerInduk = modalPengembalian.querySelector('.nomer_induk');
         const pengembalianNama = modalPengembalian.querySelector('.nama_lengkap');
         const pengembalianJk = modalPengembalian.querySelector('.jenis_kelamin');
         const pengembalianAlamat = modalPengembalian.querySelector('.alamat');

         const pengembalianTglPinjam = modalPengembalian.querySelector('.tgl_pinjam');
         const pengembalianTglTempo = modalPengembalian.querySelector('.tgl_tempo');
         const pengembalianTglKembali = modalPengembalian.querySelector('.tgl_kembalikan');
         const pengembalianHariTelat = modalPengembalian.querySelector('.total_hari_terlambat');
         const pengembalianStatusPinjaman = modalPengembalian.querySelector('.status_pinjaman');
         const pengembalianStatusPengembalian = modalPengembalian.querySelector('.status_pengembalian');

         const pengembalianKodeBuku = modalPengembalian.querySelector('.kode_buku');
         const pengembalianJudulBuku = modalPengembalian.querySelector('.judul_buku');
         const pengembalianPenulis = modalPengembalian.querySelector('.penulis');
         const pengembalianThnTerbit = modalPengembalian.querySelector('.thn_terbit');

         const pengembalianJumlahDenda = modalPengembalian.querySelector('.jumlah_denda');
         const pengembalianJumlahBayar = modalPengembalian.querySelector('.jumlah_bayar');
         const pengembalianJumlahKembalian = modalPengembalian.querySelector('.jumlah_kembalian');
         const pengembalianTotalBayar = modalPengembalian.querySelector('.total_bayar');

         btnOpenPengembalian.forEach(btn => {
             btn.addEventListener("click", function() {
                 const no_induk = this.dataset.nomer_induk;
                 const nama_lengkap = this.dataset.nama;
                 const jk = this.dataset.jk;
                 const alamat = this.dataset.alamat;

                 const tgl_pinjam = this.dataset.tgl_pinjam;
                 const tgl_tempo = this.dataset.tgl_tempo;
                 const tgl_kembalikan = this.dataset.tgl_kembalikan;
                 const hariTelat = this.dataset.total_hari_telat;

                 const status_pinjaman = this.dataset.status_pinjaman;
                 const status_kembalikan = this.dataset.status_kembalikan;

                 const kode_buku = this.dataset.kode_buku;
                 const judul_buku = this.dataset.judul_buku;
                 const penulis = this.dataset.penulis;
                 const thn_terbit = this.dataset.thn_terbit;

                 const jumlah_denda = this.dataset.jumlah_denda;
                 const jumlah_bayar = this.dataset.jumlah_bayar;
                 const jumlah_kembalian = this.dataset.jumlah_kembalian;
                 const total_bayar = this.dataset.total_bayar;

                 modalPengembalian.classList.remove("hidden");

                 pengembalianNomerInduk.value = no_induk ?? 'N/A';
                 pengembalianNama.value = nama_lengkap ?? 'N/A';
                 pengembalianJk.value = jk ?? 'N/A';
                 pengembalianAlamat.value = alamat ?? 'Tidak Ada Alamat';

                 pengembalianTglPinjam.value = tgl_pinjam ?? '-';
                 pengembalianTglTempo.value = tgl_tempo ?? '-';
                 pengembalianTglKembali.value = tgl_kembalikan ?? '-';
                 const hariFix = Math.ceil(hariTelat || 0);
                 pengembalianHariTelat.value = hariFix + " hari";

                 //  Status Peminjaman
                 pengembalianStatusPinjaman.className = 'status_pinjaman inline-flex items-center px-3 py-1 rounded-full text-xs font-medium';
                 if (status_pinjaman === "dipinjamkan" || status_pinjaman === "dipinjam") {
                     pengembalianStatusPinjaman.classList.add('bg-green-200', 'text-green-500');
                 } else if (status_pinjaman === 'dikembalikan') {
                     pengembalianStatusPinjaman.classList.add('bg-blue-200', 'text-blue-500');
                 }
                 pengembalianStatusPinjaman.innerHTML = status_pinjaman ?? '-';

                 //  Status Pengembalian
                 pengembalianStatusPengembalian.className = 'status_pengembalian inline-flex items-center px-3 py-1 rounded-full text-xs font-medium';
                 if (status_kembalikan === "menunggu") {
                     pengembalianStatusPengembalian.classList.add('bg-yellow-200', 'text-yellow-500');
                 } else if (status_kembalikan === 'dikembalikan') {
                     pengembalianStatusPengembalian.classList.add('bg-blue-200', 'text-blue-500');
                 }
                 pengembalianStatusPengembalian.innerHTML = status_kembalikan ?? '-';

                 pengembalianKodeBuku.value = kode_buku ?? '-';
                 pengembalianJudulBuku.value = judul_buku ?? '-';
                 pengembalianPenulis.value = penulis ?? '-';
                 pengembalianThnTerbit.value = thn_terbit ?? '-';

                 function convertRupiah(angka) {
                     return 'Rp ' + (parseInt(angka) || 0).toLocaleString('id-ID');
                 }

                 if (pengembalianJumlahDenda) pengembalianJumlahDenda.value = convertRupiah(jumlah_denda);
                 if (pengembalianJumlahBayar) pengembalianJumlahBayar.value = convertRupiah(jumlah_bayar);
                 if (pengembalianJumlahKembalian) pengembalianJumlahKembalian.value = convertRupiah(jumlah_kembalian);
                 if (pengembalianTotalBayar) pengembalianTotalBayar.value = convertRupiah(total_bayar);
             });

             if (btnClosePengembalian) {
                 btnClosePengembalian.addEventListener("click", function() {
                     modalPengembalian.classList.add('hidden');
                 });
             }
         });
     }
 </script>
