<?php
require_once __DIR__ . '/../includes/koneksi.php';

// Cek lokasi file JSON di Jobsheet-08, Jobsheet-07, atau Jobsheet-06
$possiblePaths = [
    __DIR__ . '/../data/buku.json',
    __DIR__ . '/../../Jobsheet-07/data/buku.json',
    __DIR__ . '/../../Jobsheet-06/data/buku.json'
];

$jsonPath = null;
foreach ($possiblePaths as $path) {
    if (file_exists($path)) {
        $jsonPath = $path;
        break;
    }
}

if (!$jsonPath) {
    die("File buku.json tidak ditemukan. Pastikan file buku.json ada di folder data/ Jobsheet-06, 07, atau 08.");
}

$dataJson = file_get_contents($jsonPath);
$bukuArray = json_decode($dataJson, true) ?? [];

if (empty($bukuArray)) {
    die("Data JSON kosong atau format tidak valid.");
}

$successCount = 0;

foreach ($bukuArray as $buku) {
    $judul        = $buku['judul'] ?? 'Tanpa Judul';
    $penulis      = $buku['pengarang'] ?? $buku['penulis'] ?? 'Unknown';
    $tahun_terbit = (int)($buku['tahun'] ?? $buku['tahun_terbit'] ?? 2024);
    $isbn         = $buku['isbn'] ?? null;
    $stok         = (int)($buku['stok'] ?? 0);
    $kategori     = $buku['kategori'] ?? 'Umum';

    $query = "INSERT INTO buku (judul, penulis, tahun_terbit, isbn, stok, kategori) VALUES ($1, $2, $3, $4, $5, $6)";
    $res = @pg_query_params($conn, $query, array($judul, $penulis, $tahun_terbit, $isbn, $stok, $kategori));

    if ($res) {
        $successCount++;
    }
}

echo "<h3>Migrasi Selesai!</h3>";
echo "Berhasil memindahkan <b>$successCount</b> data dari <i>" . htmlspecialchars($jsonPath) . "</i> ke database PostgreSQL simpus_mini.";
?>