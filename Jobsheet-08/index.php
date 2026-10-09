<?php
include 'includes/header.php';
require_once __DIR__ . '/includes/koneksi.php';

$totalBuku = 0;
$totalAnggota = 0;

if ($conn) {
    $resBuku = pg_query($conn, "SELECT COUNT(*) FROM buku");
    if ($resBuku) $totalBuku = pg_fetch_result($resBuku, 0, 0);

    $resAnggota = pg_query($conn, "SELECT COUNT(*) FROM anggota");
    if ($resAnggota) $totalAnggota = pg_fetch_result($resAnggota, 0, 0);
}
?>

<div class="container">
    <!-- Banner Selamat Datang -->
    <div class="card card-custom p-4 mb-4">
        <h3 class="text-teal fw-bold mb-2">Selamat Datang di Sistem Perpustakaan Mini</h3>
        <p class="text-secondary mb-0">Aplikasi sederhana untuk mengelola data buku dan anggota perpustakaan.</p>
    </div>

    <!-- Ringkasan Card -->
    <div class="card card-custom p-4">
        <h4 class="text-teal fw-bold mb-3">Ringkasan</h4>
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card-stat">
                    <div class="stat-title">Total Buku</div>
                    <div class="stat-value"><?= $totalBuku ?></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-stat">
                    <div class="stat-title">Total Anggota</div>
                    <div class="stat-value"><?= $totalAnggota ?></div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-stat">
                    <div class="stat-title">Sedang Dipinjam</div>
                    <div class="stat-value">0</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-stat">
                    <div class="stat-title">Buku Terlambat</div>
                    <div class="stat-value">0</div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>