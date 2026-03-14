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

    // Modal Kembalikan Buku
    const opanModalKembalikan = document.querySelectorAll(
        ".btn_open_modal_kembalikan",
    );
    const closeModalKembalikan = document.querySelector(
        ".btn_close_kembalikan",
    );
    const modalKembalikan = document.querySelector(".open_modal_kembalikan");

    if (modalKembalikan) {
        opanModalKembalikan.forEach((button) => {
            button.addEventListener("click", () => {
                modalKembalikan.classList.remove("hidden");
            });
        });

        if (closeModalKembalikan) {
            closeModalKembalikan.addEventListener("click", () => {
                modalKembalikan.classList.add("hidden");
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
    const all_form = document.querySelector(".all_form");
    const btn_simpan = document.querySelector(".btn_simpan_perubahan");
    const spinner_loading = document.querySelector(".spinner_load");
    const text_simpan = document.querySelector(".text_simpan");

    if (all_form && btn_simpan && spinner_loading && text_simpan) {
        all_form.addEventListener("submit", function () {
            btn_simpan.disabled = true;
            btn_simpan.classList.add("opacity-70", "cursor-not-allowed");
            spinner_loading.classList.remove("hidden");
            text_simpan.innerHTML = "Tunggu...";
        });
    }

    // Loading Mencari Data
    const formCari = document.querySelector(".form-cari");
    const loading_spinner = document.querySelector("#loading_spinner");
    const text_loading = document.querySelector(".text-loading");
    const modalLoading = document.querySelector(".open_modal_loading");

    if (formCari && loading_spinner && text_loading && modalLoading) {
        formCari.addEventListener("submit", function () {
            modalLoading.classList.remove("hidden");
            loading_spinner.classList.remove("hidden");
            text_loading.textContent = "Sedang mencari data...";
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
});
