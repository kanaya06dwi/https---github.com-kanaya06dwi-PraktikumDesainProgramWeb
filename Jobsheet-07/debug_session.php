<?php
$page_title = "Debug Session";
include __DIR__ . '/includes/header.php';
?>

<div class="card shadow-sm border-0 p-4">
    <h2 class="card-title h4 mb-3 text-primary fw-bold">Data Mentah $_SESSION</h2>
    <p class="text-muted small">Menginspeksi seluruh array session yang tersimpan di server saat ini:</p>
    
    <div class="bg-dark text-white p-3 rounded">
        <pre class="mb-0"><code><?php print_r($_SESSION); ?></code></pre>
    </div>
    
    <div class="mt-3">
        <a href="index.php" class="btn btn-secondary btn-sm">Kembali ke Beranda</a>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>