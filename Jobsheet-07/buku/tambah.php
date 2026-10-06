<?php
$page_title = "Tambah Buku";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>

<div class="card shadow-sm border-0 p-4">
    <h2 class="card-title h4 mb-3 text-primary fw-bold">Tambah Buku Baru</h2>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
    <?php endif; ?>

    <form id="form-tambah" action="proses_tambah.php" method="post">
        <div class="mb-3">
            <label for="judul" class="form-label fw-semibold">Judul Buku</label>
            <input type="text" class="form-control" id="judul" name="judul">
        </div>
        <div class="mb-3">
            <label for="pengarang" class="form-label fw-semibold">Pengarang</label>
            <input type="text" class="form-control" id="pengarang" name="pengarang">
        </div>
        <div class="mb-3">
            <label for="tahun" class="form-label fw-semibold">Tahun Terbit</label>
            <input type="number" class="form-control" id="tahun" name="tahun" min="1900" max="2026">
        </div>
        <div class="mb-3">
    <label for="isbn" class="form-label fw-semibold">ISBN</label>
    <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Contoh: 978-602-03-0378-9">
</div>
        <div class="mb-3">
            <label for="stok" class="form-label fw-semibold">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" min="0">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Buku</button>
        <a href="list.php" class="btn btn-outline-secondary">Batal</a>
    </form>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>