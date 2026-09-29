document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initTableFilter();
    initValidasiForm();
    initHapusConfirm();
    updateCounter();
});
/* 1. Hamburger Menu Toggle */
function initNavToggle() {
    const btn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");
    if (!btn || !nav) return;

    btn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}
/* 2. Real-Time Table Filter */
function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table, table");
    if (!input || !table) return;
    input.addEventListener("keyup", function () {
        const keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");
        rows.forEach(function (row) {
            const teksBaris = row.textContent.toLowerCase();
            row.style.display = teksBaris.includes(keyword) ? "" : "none";
        });
        updateCounter();
    });
}
/* 3. Validasi Form Tambah */
function initValidasiForm() {
    const form = document.getElementById("form-tambah");
    if (!form) return;
    form.addEventListener("submit", function (e) {
        let valid = true;
        const judul = form.querySelector("[name='judul'], [name='nama']");
        if (judul && judul.value.trim() === "") {
            tampilkanError(judul, "Judul/Nama wajib diisi.");
            valid = false;
        } else if (judul) {
            hapusError(judul);
        }
        const pengarang = form.querySelector("[name='pengarang']");
        if (pengarang && pengarang.value.trim() === "") {
            tampilkanError(pengarang, "Pengarang wajib diisi.");
            valid = false;
        } else if (pengarang) {
            hapusError(pengarang);
        }
        const tahun = form.querySelector("[name='tahun']");
        if (tahun && tahun.value.trim() !== "") {
            const nilai = parseInt(tahun.value, 10);
            if (isNaN(nilai) || nilai < 1900 || nilai > 2026) {
                tampilkanError(tahun, "Tahun harus antara 1900-2026.");
                valid = false;
            } else {
                hapusError(tahun);
            }
        }
        const isbn = form.querySelector("[name='isbn']");
        if (isbn && isbn.value.trim() !== "") {
            const isbnPattern = /^[0-9-]+$/;
            if (!isbnPattern.test(isbn.value.trim())) {
                tampilkanError(isbn, "ISBN hanya boleh berisi angka dan tanda hubung (-).");
                valid = false;
            } else {
                hapusError(isbn);
            }
        }
        const stok = form.querySelector("[name='stok']");
        if (stok && stok.value.trim() !== "") {
            const nilaiStok = parseInt(stok.value, 10);
            if (isNaN(nilaiStok) || nilaiStok < 0) {
                tampilkanError(stok, "Stok tidak boleh kurang dari 0.");
                valid = false;
            } else {
                hapusError(stok);
            }
        }
        if (!valid) {
            e.preventDefault();
        }
    });
}
/*JOBSHEET 6: EVENT DELEGATION */
function initHapusConfirm() {
    document.addEventListener("click", function (e) {
        console.log("Elemen yang diklik:", e.target);
        const btn = e.target.closest(".btn-hapus");
        if (!btn) return;

        const row = btn.closest("tr");
        const nama = row ? row.querySelector("td")?.textContent : "data ini";
        const yakin = confirm("Yakin ingin menghapus \"" + nama + "\"?");

        if (yakin && row) {
            row.remove();
            updateCounter();
        }
    });
}
/* 5. Counter Jumlah Data Real-Time */
function updateCounter() {
    const counterEl = document.getElementById("table-counter");
    const table = document.querySelector(".table-responsive table, table");
    if (!counterEl || !table) return;
    const allRows = table.querySelectorAll("tbody tr");
    let visibleCount = 0;
    allRows.forEach(function (row) {
        // Abaikan baris pesan error (colspan)
        if (row.style.display !== "none" && !row.querySelector("td[colspan]")) {
            visibleCount++;
        }
    });
    counterEl.textContent = "Menampilkan " + visibleCount + " data.";
}
/* --- FUNGSI PEMBANTU ERROR --- */
function tampilkanError(inputElement, pesan) {
    hapusError(inputElement);
    const errorEl = document.createElement("small");
    errorEl.className = "error text-danger d-block mt-1 fw-bold";
    errorEl.textContent = pesan;
    inputElement.parentNode.appendChild(errorEl);
    inputElement.classList.add("is-invalid");
}
function hapusError(inputElement) {
    const parent = inputElement.parentNode;
    const errorLama = parent.querySelector(".error");
    if (errorLama) {
        errorLama.remove();
    }
    inputElement.classList.remove("is-invalid");
}