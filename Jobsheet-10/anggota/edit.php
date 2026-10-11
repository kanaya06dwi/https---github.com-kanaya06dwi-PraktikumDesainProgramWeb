<?php
include '../includes/header.php';
require_once __DIR__ . '/../includes/koneksi.php';
require_once __DIR__ . '/../includes/auth.php';
$id = $_GET['id'] ?? null;
if (!$id || !$conn) {
    header('Location: list.php');
    exit;
}

$res = pg_query_params($conn, "SELECT * FROM anggota WHERE id = $1", array($id));
$anggota = pg_fetch_assoc($res);

if (!$anggota) {
    header('Location: list.php');
    exit;
}
?>

<div class="container">
    <div class="card card-custom p-4">
        <h3 class="text-teal fw-bold mb-4">Edit Anggota</h3>
        <form action="proses_edit.php" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyimpan perubahan data ini?');">
            <input type="hidden" name="id" value="<?= $anggota['id'] ?>">

            <div class="mb-3 col-md-6">
                <label class="form-label fw-bold">Nama *</label>
                <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($anggota['nama']) ?>" required>
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label fw-bold">Email *</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($anggota['email'] ?? '') ?>" required>
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label fw-bold">No. Anggota *</label>
                <input type="text" name="no_anggota" class="form-control" value="<?= htmlspecialchars($anggota['no_anggota']) ?>" required>
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label fw-bold">Tanggal Lahir *</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="<?= htmlspecialchars($anggota['tanggal_lahir'] ?? '') ?>" required>
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label fw-bold">Alamat *</label>
                <textarea name="alamat" class="form-control" rows="3" required><?= htmlspecialchars($anggota['alamat'] ?? '') ?></textarea>
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label fw-bold">No. HP (opsional)</label>
                <input type="text" name="no_hp" class="form-control" value="<?= htmlspecialchars($anggota['no_hp'] ?? '') ?>">
            </div>

            <button type="submit" class="btn btn-teal">Simpan Perubahan</button>
            <a href="list.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>