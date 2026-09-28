/* =========================================================
   SIMPUS-Mini - App JS (Jobsheet 5 + Ide Latihan 1-4)
   ========================================================= */

document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initTableFilter();
    initValidasiForm();
    initHapusConfirm();
    updateCounter();
});

/* 1. Hamburger Menu Toggle (Latihan 2: Smooth Transition) */
function initNavToggle() {
    const btn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");
    if (!btn || !nav) return;

    btn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}

/* 2. Real-Time Table Filter (Latihan 3: Filter Kolom Pertama / Judul / Nama) */
function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table, table");
    if (!input || !table) return;

    input.addEventListener("keyup", function () {
        const keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");

        rows.forEach(function (row) {
            // Ambil seluruh teks dalam 1 baris (Nama, No.Anggota, Alamat, dll)
            const teksBaris = row.textContent.toLowerCase();
            
            // Jika kata kunci cocok, tampilkan barisnya
            row.style.display = teksBaris.includes(keyword) ? "" : "none";
        });

        updateCounter(); // Pembaruan jumlah data
    });
}

/* 3. Validasi Form (Latihan 1: ISBN Regex) */
function initValidasiForm() {
    const form = document.getElementById("form-tambah");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        let valid = true;

        // Validasi Judul / Nama
        const judul = form.querySelector("[name='judul'], [name='nama']");
        if (judul && judul.value.trim() === "") {
            tampilkanError(judul, "Judul/Nama wajib diisi.");
            valid = false;
        } else if (judul) {
            hapusError(judul);
        }

        // Validasi Pengarang
        const pengarang = form.querySelector("[name='pengarang']");
        if (pengarang && pengarang.value.trim() === "") {
            tampilkanError(pengarang, "Pengarang wajib diisi.");
            valid = false;
        } else if (pengarang) {
            hapusError(pengarang);
        }

        // Validasi Tahun
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

        // LATIHAN 1: Validasi ISBN (Hanya angka dan -)
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

        // Validasi Stok
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

        // HENTIKAN SUBMIT JIKA ADA ERROR (Agar tidak di-refresh/disuruh isi lagi)
        if (!valid) {
            e.preventDefault();
        }
    });
}

/* 4. Konfirmasi Hapus Baris Table */
function initHapusConfirm() {
    const btnHapusList = document.querySelectorAll(".btn-hapus");
    btnHapusList.forEach(function (btn) {
        btn.addEventListener("click", function (e) {
            const konfirmasi = confirm("Apakah Anda yakin ingin menghapus data ini?");
            if (konfirmasi) {
                const tr = btn.closest("tr");
                if (tr) {
                    tr.remove();
                    updateCounter(); // Pembaruan counter setelah hapus
                }
            }
        });
    });
}

/* 5. Latihan 4: Counter Jumlah Data Real-Time */
function updateCounter() {
    const counterEl = document.getElementById("table-counter");
    const table = document.querySelector(".table-responsive table, table");
    if (!counterEl || !table) return;

    const allRows = table.querySelectorAll("tbody tr");
    let visibleCount = 0;

    allRows.forEach(function (row) {
        if (row.style.display !== "none") {
            visibleCount++;
        }
    });

    counterEl.textContent = "Menampilkan " + visibleCount + " dari " + allRows.length + " data.";
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