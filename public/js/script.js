document.addEventListener("DOMContentLoaded", () => {
    // Modal Logout
    const openModalButtons = document.querySelectorAll(".btn_open_modal");
    const closeModalButton = document.querySelector(".btn_close");
    const modal = document.querySelector(".open_modal");

    openModalButtons.forEach((button) => {
        button.addEventListener("click", () => {
            modal.classList.remove("hidden");
        });
    });

    closeModalButton.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    // Modal Kembalikan Buku
    const opanModalKembalikan = document.querySelectorAll(
        ".btn_open_modal_kembalikan",
    );
    const closeModalKembalikan = document.querySelector(".btn_close_kembalikan");
    const modalKembalikan = document.querySelector(".open_modal_kembalikan");

    opanModalKembalikan.forEach((button) => {
        button.addEventListener("click", () => {
            modalKembalikan.classList.remove("hidden");
        });
    });

    closeModalKembalikan.addEventListener("click", () => {
        modalKembalikan.classList.add("hidden");
    });
});
