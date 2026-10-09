<?php 
include '../includes/header.php'; 
require_once __DIR__ . '/../includes/koneksi.php';

if (isset($_GET['aksi']) && $_GET['aksi'] === 'hapus' && !empty($_GET['id'])) {
    pg_query_params($conn, "DELETE FROM buku WHERE id = $1", array($_GET['id']));
    header('Location: list.php');
    exit;
}

$keyword = $_GET['cari'] ?? '';
$bukuList = [];

if (!empty($keyword)) {
    $query = "SELECT * FROM buku WHERE judul ILIKE $1 OR penulis ILIKE $1 OR kategori ILIKE $1 ORDER BY id DESC";
    $result = pg_query_params($conn, $query, array("%$keyword%"));
} else {
    $query = "SELECT * FROM buku ORDER BY id DESC";
    $result = pg_query($conn, $query);
}

if ($result) {
    while ($row = pg_fetch_assoc($result)) {
        $bukuList[] = $row;
    }
}
?>

<div class="container">
    <div class="card card-custom p-4">
        <h3 class="text-teal fw-bold mb-4">Daftar Buku</h3>

        <form method="GET" class="mb-3">
            <div class="row align-items-center g-2">
                <div class="col-auto">
                    <label class="fw-bold">Cari Judul Buku</label>
                </div>
                <div class="col-md-3">
                    <input type="text" name="cari" class="form-control" placeholder="Ketik judul buku..." value="<?= htmlspecialchars($keyword) ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-teal btn-sm">Cari</button>
                    <a href="list.php" class="btn btn-secondary btn-sm">Reset</a>
                </div>
            </div>
        </form>

        <p class="text-secondary small mb-3">Menampilkan <?= count($bukuList) ?> data</p>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="bg-teal text-white">
                    <tr>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Tahun</th>
                        <th>ISBN</th>
                        <th>Stok</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($bukuList)): ?>
                        <?php foreach ($bukuList as $buku): ?>
                            <tr>
                                <td><?= htmlspecialchars($buku['judul']) ?></td>
                                <td><?= htmlspecialchars($buku['penulis']) ?></td>
                                <td><?= htmlspecialchars($buku['tahun_terbit']) ?></td>
                                <td><?= htmlspecialchars($buku['isbn'] ?? '-') ?></td>
                                <td><?= htmlspecialchars($buku['stok'] ?? 0) ?></td>
                                <td><?= htmlspecialchars($buku['kategori'] ?? 'Umum') ?></td>
                                <td>
                                    <a href="tambah.php?id=<?= $buku['id'] ?>" class="btn btn-warning btn-sm text-white">Edit</a>
                                    <a href="list.php?aksi=hapus&id=<?= $buku['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus buku ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="py-3 text-center">
                                Belum ada data buku. Silahkan tambah lewat menu "Tambah Buku".
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>