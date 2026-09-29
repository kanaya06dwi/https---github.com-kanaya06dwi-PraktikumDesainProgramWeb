async function muatDaftarAnggota() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    if (loading) loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        await new Promise((resolve) => setTimeout(resolve, 600));

        const res = await fetch("../data/anggota.json");
        if (!res.ok) {
            throw new Error("Gagal mengambil data (status " + res.status + ")");
        }
        const daftarAnggota = await res.json();
        daftarAnggota.forEach(function (anggota) {
            const tr = document.createElement("tr");
            tr.innerHTML =
                "<td>" + anggota.no_anggota + "</td>" +
                "<td>" + anggota.nama + "</td>" +
                "<td>" + anggota.alamat + "</td>" +
                "<td>" + anggota.no_hp + "</td>" +
                "<td>" +
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
}
document.addEventListener("DOMContentLoaded", muatDaftarAnggota);