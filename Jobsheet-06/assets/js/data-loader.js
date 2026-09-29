async function muatDataGenerik(urlJson, renderRowCallback) {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;

    if (loading) loading.style.display = "block";
    tbody.innerHTML = "";

    try {
        await new Promise((resolve) => setTimeout(resolve, 600));
        const res = await fetch(urlJson);
        if (!res.ok) throw new Error("Gagal mengambil data (status " + res.status + ")");

        const data = await res.json();
        data.forEach(function (item) {
            const tr = document.createElement("tr");
            tr.innerHTML = renderRowCallback(item);
            tbody.appendChild(tr);
        });

        if (typeof updateCounter === "function") updateCounter();
    } catch (err) {
        tbody.innerHTML = "<tr><td colspan='6' class='text-danger py-3'>Gagal memuat data: " + err.message + "</td></tr>";
    } finally {
        if (loading) loading.style.display = "none";
    }
}