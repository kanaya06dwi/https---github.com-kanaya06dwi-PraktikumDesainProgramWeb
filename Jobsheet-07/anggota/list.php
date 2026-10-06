<?php
$page_title = "Daftar Anggota";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftarAnggota = $_SESSION['anggota'] ?? [];
?>

<div class="card shadow-sm border-0 p-4">
    <h2 class="card-title h4 mb-3 text-primary fw-bold">Daftar Anggota</h2>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
    <?php endif; ?>

    <div class="search-box mb-3">
        <label for="search-input" class="form-label fw-semibold">Cari Anggota:</label>
        <input type="text" id="search-input" class="form-control" placeholder="Ketik kata kunci...">
        <p id="table-counter" class="text-muted small mt-2 mb-0"></p>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>No. Anggota</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($daftarAnggota)): ?>
                    <tr>
                        <td colspan="5" class="text-muted py-3">Belum ada data anggota. Silakan tambah lewat menu "Tambah Anggota".</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($daftarAnggota as $anggota): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($anggota['no_anggota']); ?></td>
                            <td><?php echo htmlspecialchars($anggota['nama']); ?></td>
                            <td><?php echo htmlspecialchars($anggota['alamat']); ?></td>
                            <td><?php echo htmlspecialchars($anggota['no_hp']); ?></td>
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