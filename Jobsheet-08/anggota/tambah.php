<?php 
include '../includes/header.php'; 

$errors = isset($_GET['err']) ? json_decode($_GET['err'], true) : [];
$id = $_GET['id'] ?? '';
$anggota = ['nama' => '', 'email' => '', 'no_anggota' => '', 'tanggal_lahir' => '', 'alamat' => '', 'no_hp' => ''];

// Jika ada ID di URL, ambil data anggota dari database untuk diedit
if (!empty($id)) {
    $conn_string = "host=127.0.0.1 port=5432 dbname=simpus_mini user=postgres password=postgres";
    $conn = @pg_connect($conn_string);
    if ($conn) {
        $res = pg_query_params($conn, "SELECT * FROM anggota WHERE id = $1", array($id));
        if ($res && $data = pg_fetch_assoc($res)) {
            $anggota = $data;
        }
        pg_close($conn);
    }
}
?>

<div class="container">
    <div class="card card-custom p-4">
        <h3 class="text-teal fw-bold mb-4"><?= !empty($id) ? 'Edit Anggota' : 'Tambah Anggota' ?></h3>

        <form action="proses_tambah.php" method="POST">
            <!-- Simpan ID secara tersembunyi jika sedang mode Edit -->
            <input type="hidden" name="id" value="<?= $id ?>">

            <div class="mb-3 col-md-5">
                <label class="form-label fw-bold">Nama <span class="text-danger">*</span></label>
                <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($anggota['nama']) ?>">
                <?php if (isset($errors['nama'])): ?>
                    <div class="error-text"><?= $errors['nama'] ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3 col-md-5">
                <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($anggota['email'] ?? '') ?>">
                <?php if (isset($errors['email'])): ?>
                    <div class="error-text"><?= $errors['email'] ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3 col-md-5">
                <label class="form-label fw-bold">No. Anggota <span class="text-danger">*</span></label>
                <input type="text" name="no_anggota" class="form-control" value="<?= htmlspecialchars($anggota['no_anggota']) ?>">
                <?php if (isset($errors['no_anggota'])): ?>
                    <div class="error-text"><?= $errors['no_anggota'] ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3 col-md-5">
                <label class="form-label fw-bold">Tanggal Lahir <span class="text-danger">*</span></label>
                <input type="date" name="tanggal_lahir" class="form-control" value="<?= htmlspecialchars($anggota['tanggal_lahir'] ?? '') ?>">
                <?php if (isset($errors['tanggal_lahir'])): ?>
                    <div class="error-text"><?= $errors['tanggal_lahir'] ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3 col-md-5">
                <label class="form-label fw-bold">Alamat <span class="text-danger">*</span></label>
                <textarea name="alamat" class="form-control" rows="2"><?= htmlspecialchars($anggota['alamat'] ?? '') ?></textarea>
                <?php if (isset($errors['alamat'])): ?>
                    <div class="error-text"><?= $errors['alamat'] ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3 col-md-5">
                <label class="form-label fw-bold">No. HP (opsional)</label>
                <input type="text" name="no_hp" class="form-control" value="<?= htmlspecialchars($anggota['no_hp'] ?? '') ?>">
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-teal px-4"><?= !empty($id) ? 'Update' : 'Simpan' ?></button>
            </div>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>