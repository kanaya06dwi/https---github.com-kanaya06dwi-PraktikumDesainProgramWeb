async function muatDaftarBuku() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    if (loading) loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        await new Promise((resolve) => setTimeout(resolve, 3000));
        const res = await fetch("../data/buku.json");
        if (!res.ok) {
            throw new Error("Gagal mengambil data (status " + res.status + ")");
        }
        const daftarBuku = await res.json();
        daftarBuku.forEach(function (buku) {
            const tr = document.createElement("tr");
            tr.innerHTML =
                "<td>" + buku.judul + "</td>" +
                "<td>" + buku.pengarang + "</td>" +
                "<td>" + buku.tahun + "</td>" +
                "<td>" + buku.stok + "</td>" +
                "<td>" + (buku.kategori || "-") + "</td>" + // Render kategori
                "<td><button type=\"button\" class=\"btn-hapus\">Hapus</button></td>"
                "<button type=\"button\" class=\"btn btn-warning btn-sm me-1 text-white\">Edit</button> " +
                "<button type=\"button\" class=\"btn btn-danger btn-sm btn-hapus\">Hapus</button>" +
                "</td>";
            tbody.appendChild(tr);
        });
        if (typeof updateCounter === "function") {
            updateCounter();
        }
    } catch (err) {
        tbody.innerHTML =
            "<tr><td colspan=\"5\" class=\"text-center text-danger py-3\">Gagal memuat data: " + err.message + "</td></tr>";
    } finally {
        if (loading) loading.style.display = "none";
    }
    // Listener Latihan 1
const btnReload = document.getElementById("btn-reload");
if (btnReload) {
    btnReload.addEventListener("click", muatDaftarBuku);
}
}
document.addEventListener("DOMContentLoaded", muatDaftarBuku);