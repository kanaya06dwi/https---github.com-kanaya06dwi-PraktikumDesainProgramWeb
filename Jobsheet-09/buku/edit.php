<?php
include '../includes/header.php';
require_once __DIR__ . '/../includes/koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id || !$conn) {
    header('Location: list.php');
    exit;
}

$res = pg_query_params($conn, "SELECT * FROM buku WHERE id = $1", array($id));
$buku = pg_fetch_assoc($res);

if (!$buku) {
    header('Location: list.php');
    exit;
}
?>

<div class="container">
    <div class="card card-custom p-4">
        <h3 class="text-teal fw-bold mb-4">Edit Buku</h3>
        <form action="proses_edit.php" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyimpan perubahan data ini?');">
            <input type="hidden" name="id" value="<?= $buku['id'] ?>">

            <div class="mb-3 col-md-6">
                <label class="form-label fw-bold">Judul *</label>
                <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($buku['judul']) ?>" required>
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label fw-bold">Pengarang *</label>
                <input type="text" name="pengarang" class="form-control" value="<?= htmlspecialchars($buku['penulis']) ?>" required>
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label fw-bold">Tahun Terbit *</label>
                <input type="number" name="tahun_terbit" class="form-control" value="<?= htmlspecialchars($buku['tahun_terbit']) ?>" required>
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label fw-bold">ISBN</label>
                <input type="text" name="isbn" class="form-control" value="<?= htmlspecialchars($buku['isbn'] ?? '') ?>">
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label fw-bold">Stok *</label>
                <input type="number" name="stok" class="form-control" value="<?= htmlspecialchars($buku['stok'] ?? 0) ?>" required>
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label fw-bold">Kategori *</label>
                <select name="kategori" class="form-select">
                    <option value="Fiksi" <?= ($buku['kategori'] ?? '') === 'Fiksi' ? 'selected' : '' ?>>Fiksi</option>
                    <option value="Non-Fiksi" <?= ($buku['kategori'] ?? '') === 'Non-Fiksi' ? 'selected' : '' ?>>Non-Fiksi</option>
                    <option value="Pemrograman" <?= ($buku['kategori'] ?? '') === 'Pemrograman' ? 'selected' : '' ?>>Pemrograman</option>
                    <option value="Referensi" <?= ($buku['kategori'] ?? '') === 'Referensi' ? 'selected' : '' ?>>Referensi</option>
                </select>
            </div>
            <button type="submit" class="btn btn-teal">Simpan Perubahan</button>
            <a href="list.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>