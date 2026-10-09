<?php 
include '../includes/header.php'; 
require_once __DIR__ . '/../includes/koneksi.php';

if (isset($_GET['aksi']) && $_GET['aksi'] === 'hapus' && !empty($_GET['id'])) {
    pg_query_params($conn, "DELETE FROM anggota WHERE id = $1", array($_GET['id']));
    header('Location: list.php');
    exit;
}

$keyword = $_GET['cari'] ?? '';
$anggotaList = [];

if (!empty($keyword)) {
    $query = "SELECT * FROM anggota WHERE nama ILIKE $1 OR no_anggota ILIKE $1 OR alamat ILIKE $1 ORDER BY id DESC";
    $result = pg_query_params($conn, $query, array("%$keyword%"));
} else {
    $query = "SELECT * FROM anggota ORDER BY id DESC";
    $result = pg_query($conn, $query);
}

if ($result) {
    while ($row = pg_fetch_assoc($result)) {
        $anggotaList[] = $row;
    }
}
?>

<div class="container">
    <div class="card card-custom p-4">
        <h3 class="text-teal fw-bold mb-4">Daftar Anggota</h3>

        <form method="GET" class="mb-3">
            <div class="row align-items-center g-2">
                <div class="col-auto">
                    <label class="fw-bold">Cari Nama Anggota</label>
                </div>
                <div class="col-md-3">
                    <input type="text" name="cari" class="form-control" placeholder="Ketik nama..." value="<?= htmlspecialchars($keyword) ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-teal btn-sm">Cari</button>
                    <a href="list.php" class="btn btn-secondary btn-sm">Reset</a>
                </div>
            </div>
        </form>

        <p class="text-secondary small mb-3">Menampilkan <?= count($anggotaList) ?> data</p>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="bg-teal text-white">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. Anggota</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>No. HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($anggotaList)): ?>
                        <?php foreach ($anggotaList as $anggota): ?>
                            <tr>
                                <td><?= htmlspecialchars($anggota['nama']) ?></td>
                                <td><?= htmlspecialchars($anggota['email'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($anggota['no_anggota']) ?></td>
                                <td><?= htmlspecialchars($anggota['tanggal_lahir'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($anggota['alamat'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($anggota['no_hp'] ?? '-') ?></td>
                                <td>
                                    <a href="tambah.php?id=<?= $anggota['id'] ?>" class="btn btn-warning btn-sm text-white">Edit</a>
                                    <a href="list.php?aksi=hapus&id=<?= $anggota['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus anggota ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="py-3 text-center">
                                Belum ada data anggota. Silakan tambah lewat menu "Tambah Anggota".
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>