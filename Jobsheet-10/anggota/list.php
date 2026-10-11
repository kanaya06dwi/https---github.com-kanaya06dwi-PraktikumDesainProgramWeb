<?php 
include '../includes/header.php'; 
require_once __DIR__ . '/../includes/koneksi.php';

$perPage = 10;
$page    = max(1, (int)($_GET['page'] ?? 1));
$offset  = ($page - 1) * $perPage;
$keyword = trim($_GET['q'] ?? '');

$anggotaList = [];
$totalRows   = 0;

if ($conn) {
    if ($keyword !== '') {
        $resCount = pg_query_params($conn, "SELECT COUNT(*) FROM anggota WHERE nama ILIKE $1 OR no_anggota ILIKE $1 OR alamat ILIKE $1", array("%$keyword%"));
        if ($resCount) $totalRows = (int)pg_fetch_result($resCount, 0, 0);

        $query = "SELECT * FROM anggota WHERE nama ILIKE $1 OR no_anggota ILIKE $1 OR alamat ILIKE $1 ORDER BY id DESC LIMIT $2 OFFSET $3";
        $result = pg_query_params($conn, $query, array("%$keyword%", $perPage, $offset));
    } else {
        $resCount = pg_query($conn, "SELECT COUNT(*) FROM anggota");
        if ($resCount) $totalRows = (int)pg_fetch_result($resCount, 0, 0);

        $query = "SELECT * FROM anggota ORDER BY id DESC LIMIT $1 OFFSET $2";
        $result = pg_query_params($conn, $query, array($perPage, $offset));
    }

    if ($result) {
        while ($row = pg_fetch_assoc($result)) {
            $anggotaList[] = $row;
        }
    }
}

$totalPages = max(1, (int)ceil($totalRows / $perPage));
?>

<div class="container">
    <div class="card card-custom p-4">
        <h3 class="text-teal fw-bold mb-4">Daftar Anggota</h3>

        <form method="GET" action="list.php" class="mb-3">
            <div class="row align-items-center g-2">
                <div class="col-auto">
                    <label class="fw-bold">Cari Anggota</label>
                </div>
                <div class="col-md-3">
                    <input type="text" name="q" class="form-control" placeholder="Ketik nama / no. anggota..." value="<?= htmlspecialchars($keyword) ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-teal btn-sm">Cari</button>
                    <a href="list.php" class="btn btn-secondary btn-sm">Reset</a>
                </div>
            </div>
        </form>

        <p class="text-secondary small mb-3">Menampilkan <?= count($anggotaList) ?> dari total <?= $totalRows ?> data</p>

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
                                    <a href="edit.php?id=<?= $anggota['id'] ?>" class="btn btn-warning btn-sm text-white me-1">Edit</a>
                                    
                                    <form class="form-hapus d-inline" method="POST" action="hapus.php">
                                        <input type="hidden" name="id" value="<?= $anggota['id'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="py-3 text-center">Belum ada data anggota.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if ($totalPages > 1): ?>
            <nav class="mt-3">
                <ul class="pagination pagination-sm mb-0">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                            <a class="page-link" href="list.php?page=<?= $i ?><?= $keyword !== '' ? '&q=' . urlencode($keyword) : '' ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>