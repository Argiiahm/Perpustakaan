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
                     <div>
                         <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Status</label>
                         <span class="status inline-flex items-center px-3 py-1 rounded-full text-xs font-medium">
                             -
                         </span>
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
             </div>
         </div>
     </div>
 </section>

 <script>
     // Modal Detail Pengembalian
     const btnOpenPengembalian = document.querySelectorAll('.openModalDetailPengembalian');
     const modalPengembalian = document.querySelector('.modal_detail_Pengembalian');
     const btnClosePengembalian = document.querySelector('.closeModalPengembalian');

     const pengembalianNomerInduk = document.querySelector('.nomer_induk');
     const pengembalianNama = document.querySelector('.nama_lengkap');
     const pengembalianJk = document.querySelector('.jenis_kelamin');
     const pengembalianAlamat = document.querySelector('.alamat');

     const pengembalianTglPinjam = document.querySelector('.tgl_pinjam');
     const pengembalianTglTempo = document.querySelector('.tgl_tempo');
     const pengembalianTglKembali = document.querySelector('.tgl_kembalikan');
     const pengembalianHariTelat = document.querySelector('.total_hari_terlambat');
     const pengembalianStatus = document.querySelector('.status');

     const pengembalianKodeBuku = document.querySelector('.kode_buku');
     const pengembalianJudulBuku = document.querySelector('.judul_buku');
     const pengembalianPenulis = document.querySelector('.penulis');
     const pengembalianThnTerbit = document.querySelector('.thn_terbit');

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

             const status = this.dataset.status;
             const kode_buku = this.dataset.kode_buku;
             const judul_buku = this.dataset.judul_buku;
             const penulis = this.dataset.penulis;
             const thn_terbit = this.dataset.thn_terbit;

             modalPengembalian.classList.remove("hidden");

             pengembalianNomerInduk.value = no_induk ?? 'N/A';
             pengembalianNama.value = nama_lengkap ?? 'N/A';
             pengembalianJk.value = jk ?? 'N/A';
             pengembalianAlamat.value = alamat ?? 'Tidak Ada Alamat';

             pengembalianTglPinjam.value = tgl_pinjam ?? '-';
             pengembalianTglTempo.value = tgl_tempo ?? '-';
             pengembalianTglKembali.value = tgl_kembalikan ?? '-';
             pengembalianHariTelat.value = hariTelat ?? 0;

             // reset class dulu biar ga numpuk
             pengembalianStatus.className =
                 "status inline-flex items-center px-3 py-1 rounded-full text-xs font-medium";

             if (status === "dipinjamkan" || status === "dipinjam") {
                 pengembalianStatus.classList.add('bg-green-200', 'text-green-500');
             } else if (status === "ditolak") {
                 pengembalianStatus.classList.add('bg-red-200', 'text-red-500');
             } else {
                 pengembalianStatus.classList.add('bg-yellow-200', 'text-yellow-500');
             }

             pengembalianStatus.innerHTML = status ?? '-';

             pengembalianKodeBuku.value = kode_buku ?? '-';
             pengembalianJudulBuku.value = judul_buku ?? '-';
             pengembalianPenulis.value = penulis ?? '-';
             pengembalianThnTerbit.value = thn_terbit ?? '-';
         });
     });

     btnClosePengembalian.addEventListener("click", function() {
         modalPengembalian.classList.add('hidden');
     });
 </script>
