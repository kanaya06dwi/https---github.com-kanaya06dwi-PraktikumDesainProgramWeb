<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id            = $_POST['id'] ?? '';
    $nama          = trim($_POST['nama'] ?? '');
    $email         = trim($_POST['email'] ?? '');
    $no_anggota    = trim($_POST['no_anggota'] ?? '');
    $tanggal_lahir = trim($_POST['tanggal_lahir'] ?? '');
    $alamat        = trim($_POST['alamat'] ?? '');
    $no_hp         = trim($_POST['no_hp'] ?? '');

    $errors = [];
    if (empty($nama)) $errors['nama'] = "Nama wajib diisi.";
    if (empty($no_anggota)) $errors['no_anggota'] = "No. Anggota wajib diisi.";

    if (!empty($errors)) {
        header("Location: tambah.php?err=" . urlencode(json_encode($errors)));
        exit;
    }

    require_once __DIR__ . '/../includes/koneksi.php';

    $tgl = !empty($tanggal_lahir) ? $tanggal_lahir : null;

    if (!empty($id)) {
        $query = "UPDATE anggota SET nama=$1, email=$2, no_anggota=$3, tanggal_lahir=$4, alamat=$5, no_hp=$6 WHERE id=$7";
        $result = pg_query_params($conn, $query, array($nama, $email, $no_anggota, $tgl, $alamat, $no_hp, $id));
    } else {
        $query = "INSERT INTO anggota (nama, email, no_anggota, tanggal_lahir, alamat, no_hp) VALUES ($1, $2, $3, $4, $5, $6)";
        $result = pg_query_params($conn, $query, array($nama, $email, $no_anggota, $tgl, $alamat, $no_hp));
    }

    if (!$result) {
        die("Gagal simpan anggota: " . pg_last_error($conn));
    }

    pg_close($conn);
    header('Location: list.php');
    exit;
}
?>