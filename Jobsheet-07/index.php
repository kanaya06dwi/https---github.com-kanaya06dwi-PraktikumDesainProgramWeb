<?php
$page_title = "Beranda";
include __DIR__ . '/includes/header.php';

$totalBuku = count($_SESSION['buku'] ?? []);
$totalAnggota = count($_SESSION['anggota'] ?? []);
$sedangDipinjam = 0;
$bukuTerlambat = 0;
?>

<div class="card shadow-sm border-0 mb-4 p-4">
    <h1 class="h3 fw-bold text-primary">Selamat Datang di Sistem Perpustakaan Mini</h1>
    <p class="text-muted mb-0">Aplikasi sederhana untuk mengelola data buku dan anggota perpustakaan.</p>
</div>

<div class="card shadow-sm border-0 p-4">
    <h2 class="h5 fw-bold text-primary mb-3">Ringkasan</h2>
    <div class="row g-3">
        <div class="col-md-3">
            <div class="border rounded p-3 text-center">
                <p class="text-muted small mb-1">Total Buku</p>
                <p class="display-6 fw-bold text-primary mb-0"><?php echo $totalBuku; ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="border rounded p-3 text-center">
                <p class="text-muted small mb-1">Total Anggota</p>
                <p class="display-6 fw-bold text-primary mb-0"><?php echo $totalAnggota; ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="border rounded p-3 text-center">
                <p class="text-muted small mb-1">Sedang dipinjam</p>
                <p class="display-6 fw-bold text-primary mb-0"><?php echo $sedangDipinjam; ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="border rounded p-3 text-center">
                <p class="text-muted small mb-1">Buku Terlambat</p>
                <p class="display-6 fw-bold text-primary mb-0"><?php echo $bukuTerlambat; ?></p>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>