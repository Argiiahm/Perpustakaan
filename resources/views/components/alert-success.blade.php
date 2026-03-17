    {{-- Modal Alert sukses --}}
    @if (session('success'))
        <section id="success-modal" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            <div class="fixed inset-0 bg-[#0F172A]/60 backdrop-blur-sm"></div>

            <div class="relative w-full max-w-[400px] overflow-hidden rounded-3xl bg-white shadow-2xl">
                <div class="px-8 pb-8 pt-10">
                    <div class="mb-6 flex justify-center">
                        <div class="relative">
                            <div class="absolute inset-0 scale-150 animate-pulse rounded-full bg-purple-50 opacity-50">
                            </div>
                            <div
                                class="relative flex h-24 w-24 items-center justify-center rounded-full bg-purple-50 ring-1 ring-purple-100">
                                <img class="w-16 h-16 object-contain" src="{{ asset('icons/svg/lamp-success.svg') }}"
                                    alt="Success">
                            </div>
                        </div>
                    </div>

                    {{-- Konten Teks --}}
                    <div class="text-center">
                        <h3 class="mb-2 text-2xl tracking-tight text-[#35094D]">
                            Berhasil!
                        </h3>
                        <p class="text-sm leading-relaxed text-slate-500">
                            {{ session('success') }}
                        </p>
                    </div>

                    {{-- Action Button --}}
                    <div class="mt-8">
                        <button id="close-btn"
                            class="group relative flex w-full items-center justify-center gap-2 overflow-hidden rounded-2xl bg-[#35094D] py-4 font-bold text-white transition-all hover:bg-[#2a073d] active:scale-[0.97]">
                            <span>Tutup Jendela</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <script>
            document.getElementById('close-btn')?.addEventListener('click', function() {
                document.getElementById('success-modal').remove();
                location.reload();
            });
        </script>
    @endif
