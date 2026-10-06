<?php
$page_title = "Daftar Buku";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftarBuku = $_SESSION['buku'] ?? [];
?>

<div class="card shadow-sm border-0 p-4">
    <h2 class="card-title h4 mb-3 text-primary fw-bold">Daftar Buku</h2>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
    <?php endif; ?>

    <div class="search-box mb-3">
        <label for="search-input" class="form-label fw-semibold">Cari Buku:</label>
        <input type="text" id="search-input" class="form-control" placeholder="Ketik kata kunci...">
        <p id="table-counter" class="text-muted small mt-2 mb-0"></p>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>ISBN</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($daftarBuku)): ?>
                    <tr>
                        <td colspan="5" class="text-muted py-3">Belum ada data buku. Silakan tambah lewat menu "Tambah Buku".</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($daftarBuku as $buku): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($buku['judul']); ?></td>
                            <td><?php echo htmlspecialchars($buku['pengarang']); ?></td>
                            <td><?php echo (int) $buku['tahun']; ?></td>
                            <td><?php echo htmlspecialchars($buku['isbn']); ?></td>
                            <td><?php echo (int) $buku['stok']; ?></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm me-1 text-white">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm btn-hapus">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>