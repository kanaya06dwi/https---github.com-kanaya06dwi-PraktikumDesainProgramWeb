<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id           = $_POST['id'] ?? '';
    $judul        = trim($_POST['judul'] ?? '');
    $penulis      = trim($_POST['pengarang'] ?? '');
    $tahun_terbit = trim($_POST['tahun_terbit'] ?? '');
    $isbn         = trim($_POST['isbn'] ?? '');
    $stok         = trim($_POST['stok'] ?? '');
    $kategori     = trim($_POST['kategori'] ?? 'Fiksi');

    $errors = [];
    if (empty($judul)) $errors['judul'] = "Judul wajib diisi.";
    if (empty($penulis)) $errors['pengarang'] = "Pengarang wajib diisi.";

    if (!empty($errors)) {
        header("Location: tambah.php?err=" . urlencode(json_encode($errors)));
        exit;
    }

    require_once __DIR__ . '/../includes/koneksi.php';

    if (!empty($id)) {
        $query = "UPDATE buku SET judul=$1, penulis=$2, tahun_terbit=$3, isbn=$4, stok=$5, kategori=$6 WHERE id=$7";
        $result = pg_query_params($conn, $query, array($judul, $penulis, (int)$tahun_terbit, $isbn, (int)$stok, $kategori, $id));
    } else {
        $query = "INSERT INTO buku (judul, penulis, tahun_terbit, isbn, stok, kategori) VALUES ($1, $2, $3, $4, $5, $6)";
        $result = pg_query_params($conn, $query, array($judul, $penulis, (int)$tahun_terbit, $isbn, (int)$stok, $kategori));
    }

    if (!$result) {
        die("Gagal simpan buku: " . pg_last_error($conn));
    }

    pg_close($conn);
    header('Location: list.php');
    exit;
}
?>