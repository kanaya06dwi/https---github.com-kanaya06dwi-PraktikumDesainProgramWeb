<?php
$page_title = "Tambah Anggota";
include __DIR__ . '/../includes/header.php';

// Ambil pesan flash jika ada error dari server
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>

<div class="card shadow-sm border-0 p-4">
    <h2 class="h4 fw-bold text-primary mb-4">Tambah Anggota Baru</h2>

    <?php if ($flash): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <?php echo htmlspecialchars($flash['pesan']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form action="proses_tambah.php" method="POST" novalidate>
        <div class="mb-3">
            <label for="no_anggota" class="form-label fw-semibold">No. Anggota <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="no_anggota" name="no_anggota" placeholder="Contoh: A001">
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap">
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label fw-semibold">Alamat <span class="text-danger">*</span></label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap (minimal 5 karakter)"></textarea>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label fw-semibold">No. HP <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Contoh: 081234567890 (10-13 digit)">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4">Simpan Anggota</button>
            <a href="list.php" class="btn btn-outline-secondary px-4">Batal</a>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>