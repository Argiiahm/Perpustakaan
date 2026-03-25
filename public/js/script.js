document.addEventListener("DOMContentLoaded", () => {
    // Modal Logout
    const openModalButtons = document.querySelectorAll(".btn_open_modal");
    const closeModalButton = document.querySelector(".btn_close");
    const modal = document.querySelector(".open_modal");

    if (modal) {
        openModalButtons.forEach((button) => {
            button.addEventListener("click", () => {
                modal.classList.remove("hidden");
            });
        });

        if (closeModalButton) {
            closeModalButton.addEventListener("click", () => {
                modal.classList.add("hidden");
            });
        }
    }

    // Modal Ajukan Buku
    const openModalAjukanBukku = document.querySelectorAll(
        ".btn_open_modal_ajukan",
    );
    const closeModalAjukan = document.querySelector(".btn_close_ajukan");
    const modalAjukan = document.querySelector(".open_modal_ajukan");

    if (modalAjukan) {
        openModalAjukanBukku.forEach((button) => {
            button.addEventListener("click", () => {
                modalAjukan.classList.remove("hidden");
            });
        });

        if (closeModalAjukan) {
            closeModalAjukan.addEventListener("click", () => {
                modalAjukan.classList.add("hidden");
            });
        }
    }

    // Preview Profile
    const uploadBtn = document.querySelector(".uploadBtn");
    const photoInput = document.querySelector(".photoInput");
    const photoPreview = document.querySelector(".photoPreview");

    if (uploadBtn && photoInput && photoPreview) {
        uploadBtn.addEventListener("click", () => {
            photoInput.click();
        });

        photoInput.addEventListener("change", function () {
            const file = this.files[0];
            if (file) {
                photoPreview.src = URL.createObjectURL(file);
            }
        });
    }

    // Simpan Perubahan Profile - Loading
    document.querySelectorAll(".all_form").forEach((form) => {
        form.addEventListener("submit", function () {
            const btn = form.querySelector(".btn_simpan_perubahan");
            const spinner = form.querySelector(".spinner_load");
            const text = form.querySelector(".text_simpan");

            if (btn && spinner && text) {
                btn.disabled = true;
                btn.classList.add("opacity-70", "cursor-not-allowed");
                spinner.classList.remove("hidden");
                text.innerHTML = "Tunggu...";
            }
        });
    });
    // Loading Mencari Data
    const formsCari = document.querySelectorAll(".form-cari");
    const loading_spinner = document.querySelector("#loading_spinner");
    const text_loading = document.querySelector(".text-loading");
    const modalLoading = document.querySelector(".open_modal_loading");

    if (formsCari.length > 0 && loading_spinner && text_loading && modalLoading) {
        formsCari.forEach((form) => {
            form.addEventListener("submit", function () {
                modalLoading.classList.remove("hidden");
                loading_spinner.classList.remove("hidden");
                
                if (this.action.includes('cetak-pdf')) {
                    text_loading.textContent = "Sedang menyiapkan PDF...";
                } else {
                    text_loading.textContent = "Sedang mencari data...";
                }
                
                setTimeout(() => {
                    modalLoading.classList.add("hidden");
                    loading_spinner.classList.add("hidden");
                }, 3000);
            });
        });
    }

    // Modal Delete Pengguna
    const modalDelete = document.querySelector(".open_modal_delete_pengguna");
    const closeBtn = modalDelete?.querySelector(".btn_close_delete_pengguna");
    const deleteForm = modalDelete?.querySelector(".delete_form_pengguna");
    const deleteButtons = document.querySelectorAll(".btn_open_delete");
    const spinner = deleteForm?.querySelector(".spinner_delete");
    const textBtn = deleteForm?.querySelector(".text_close_delete_pengguna");

    if (modalDelete && deleteForm && deleteButtons.length > 0) {
        // Buka modal & set action form sesuai row
        deleteButtons.forEach((btn) => {
            btn.addEventListener("click", () => {
                const userId = btn.dataset.userId;
                deleteForm.action = `/daftar-pengguna/${userId}`;
                modalDelete.classList.remove("hidden");
            });
        });

        // Tutup modal via tombol Batal
        closeBtn?.addEventListener("click", () => {
            modalDelete.classList.add("hidden");
        });

        // Tutup modal dengan klik background
        modalDelete.addEventListener("click", (e) => {
            if (e.target === modalDelete) {
                modalDelete.classList.add("hidden");
            }
        });

        // Submit form → spinner + disable button
        deleteForm.addEventListener("submit", () => {
            const submitBtn = deleteForm.querySelector(".btn_delete_pengguna");
            submitBtn.disabled = true;
            submitBtn.classList.add("opacity-70", "cursor-not-allowed");
            spinner.classList.remove("hidden");
            textBtn.innerText = "Tunggu...";
        });
    }

    // Modal Delete Buku
    const modalDeleteBuku = document.querySelector(".open_modal_delete_buku");
    const closeBtnBuku = modalDeleteBuku?.querySelector(
        ".btn_close_delete_buku",
    );
    const deleteFormBuku = modalDeleteBuku?.querySelector(".delete_form_buku");
    const deleteButtonsBuku = document.querySelectorAll(
        ".btn_open_delete_buku",
    );
    const spinnerBuku = deleteFormBuku?.querySelector(".spinner_delete");
    const textBtnBuku = deleteFormBuku?.querySelector(
        ".text_close_delete_buku",
    );

    if (modalDeleteBuku && deleteFormBuku && deleteButtonsBuku.length > 0) {
        // Buka modal & set action form sesuai row
        deleteButtonsBuku.forEach((btn) => {
            btn.addEventListener("click", () => {
                const bukuId = btn.dataset.bukuId;
                deleteFormBuku.action = `/kelola-buku/${bukuId}`;
                modalDeleteBuku.classList.remove("hidden");
            });
        });

        // Tutup modal via tombol Batal
        closeBtnBuku?.addEventListener("click", () => {
            modalDeleteBuku.classList.add("hidden");
        });

        // Tutup modal dengan klik background
        modalDeleteBuku.addEventListener("click", (e) => {
            if (e.target === modalDeleteBuku) {
                modalDeleteBuku.classList.add("hidden");
            }
        });

        // Submit form → spinner + disable button
        deleteFormBuku.addEventListener("submit", () => {
            const submitBtn = deleteFormBuku.querySelector(".btn_delete_buku");
            submitBtn.disabled = true;
            submitBtn.classList.add("opacity-70", "cursor-not-allowed");
            spinnerBuku.classList.remove("hidden");
            textBtnBuku.innerText = "Tunggu...";
        });
    }
});
