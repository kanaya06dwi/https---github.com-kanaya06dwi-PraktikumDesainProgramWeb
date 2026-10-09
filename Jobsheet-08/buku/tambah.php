<?php 
include '../includes/header.php'; 

$errors = isset($_GET['err']) ? json_decode($_GET['err'], true) : [];
$id = $_GET['id'] ?? '';
$buku = ['judul' => '', 'penulis' => '', 'tahun_terbit' => '', 'isbn' => '', 'stok' => '', 'kategori' => 'Fiksi'];

// Kalo ada ID, ambil data buku dari database buat diedit
if (!empty($id)) {
    $conn_string = "host=127.0.0.1 port=5432 dbname=simpus_mini user=postgres password=postgres";
    $conn = @pg_connect($conn_string);
    if ($conn) {
        $res = pg_query_params($conn, "SELECT * FROM buku WHERE id = $1", array($id));
        if ($res && $data = pg_fetch_assoc($res)) {
            $buku = $data;
        }
        pg_close($conn);
    }
}
?>

<div class="container">
    <div class="card card-custom p-4">
        <h3 class="text-teal fw-bold mb-4"><?= !empty($id) ? 'Edit Buku' : 'Tambah Buku' ?></h3>

        <form action="proses_tambah.php" method="POST">
            <!-- Simpan ID jika sedang edit -->
            <input type="hidden" name="id" value="<?= $id ?>">

            <div class="mb-3 col-md-5">
                <label class="form-label fw-bold">Judul <span class="text-danger">* Wajib</span></label>
                <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($buku['judul']) ?>">
                <?php if (isset($errors['judul'])): ?>
                    <div class="error-text"><?= $errors['judul'] ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3 col-md-5">
                <label class="form-label fw-bold">Pengarang <span class="text-danger">*</span></label>
                <input type="text" name="pengarang" class="form-control" value="<?= htmlspecialchars($buku['penulis']) ?>">
                <?php if (isset($errors['pengarang'])): ?>
                    <div class="error-text"><?= $errors['pengarang'] ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3 col-md-5">
                <label class="form-label fw-bold">Tahun Terbit <span class="text-danger">*</span></label>
                <input type="number" name="tahun_terbit" class="form-control" value="<?= htmlspecialchars($buku['tahun_terbit']) ?>">
                <?php if (isset($errors['tahun_terbit'])): ?>
                    <div class="error-text"><?= $errors['tahun_terbit'] ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3 col-md-5">
                <label class="form-label fw-bold">ISBN (opsional)</label>
                <input type="text" name="isbn" class="form-control" value="<?= htmlspecialchars($buku['isbn'] ?? '') ?>">
            </div>

            <div class="mb-3 col-md-5">
                <label class="form-label fw-bold">Stok <span class="text-danger">*</span></label>
                <input type="number" name="stok" class="form-control" value="<?= htmlspecialchars($buku['stok']) ?>">
                <?php if (isset($errors['stok'])): ?>
                    <div class="error-text"><?= $errors['stok'] ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3 col-md-5">
                <label class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                <select name="kategori" class="form-select">
                    <option value="Fiksi" <?= ($buku['kategori'] == 'Fiksi') ? 'selected' : '' ?>>Fiksi</option>
                    <option value="Pemrograman" <?= ($buku['kategori'] == 'Pemrograman') ? 'selected' : '' ?>>Pemrograman</option>
                    <option value="Sains" <?= ($buku['kategori'] == 'Sains') ? 'selected' : '' ?>>Sains</option>
                    <option value="Umum" <?= ($buku['kategori'] == 'Umum') ? 'selected' : '' ?>>Umum</option>
                </select>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-teal px-4"><?= !empty($id) ? 'Update' : 'Simpan' ?></button>
            </div>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>