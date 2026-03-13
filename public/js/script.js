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
    const form_profile = document.querySelector(".profile-form");
    const btn_simpan = document.querySelector(".btn_simpan_perubahan");
    const spinner_loading = document.querySelector(".spinner_load");
    const text_simpan = document.querySelector(".text_simpan");

    if (form_profile && btn_simpan && spinner_loading && text_simpan) {
        form_profile.addEventListener("submit", function () {
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
});
