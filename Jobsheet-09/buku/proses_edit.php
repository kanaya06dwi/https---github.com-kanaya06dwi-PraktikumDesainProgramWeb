<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id           = $_POST['id'] ?? '';
    $judul        = trim($_POST['judul'] ?? '');
    $penulis      = trim($_POST['pengarang'] ?? '');
    $tahun_terbit = trim($_POST['tahun_terbit'] ?? '');
    $isbn         = trim($_POST['isbn'] ?? '');
    $stok         = trim($_POST['stok'] ?? '');
    $kategori     = trim($_POST['kategori'] ?? 'Fiksi');

    if (empty($id)) {
        header('Location: list.php');
        exit;
    }

    require_once __DIR__ . '/../includes/koneksi.php';

    if ($conn) {
        $query = "UPDATE buku SET judul=$1, penulis=$2, tahun_terbit=$3, isbn=$4, stok=$5, kategori=$6 WHERE id=$7";
        pg_query_params($conn, $query, array($judul, $penulis, (int)$tahun_terbit, $isbn, (int)$stok, $kategori, $id));
        pg_close($conn);
    }

    header('Location: list.php');
    exit;
}
?>