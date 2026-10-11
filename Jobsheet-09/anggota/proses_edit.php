<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id            = $_POST['id'] ?? '';
    $nama          = trim($_POST['nama'] ?? '');
    $email         = trim($_POST['email'] ?? '');
    $no_anggota    = trim($_POST['no_anggota'] ?? '');
    $tanggal_lahir = trim($_POST['tanggal_lahir'] ?? '');
    $alamat        = trim($_POST['alamat'] ?? '');
    $no_hp         = trim($_POST['no_hp'] ?? '');

    if (empty($id)) {
        header('Location: list.php');
        exit;
    }

    require_once __DIR__ . '/../includes/koneksi.php';

    $tgl = !empty($tanggal_lahir) ? $tanggal_lahir : null;

    if ($conn) {
        $query = "UPDATE anggota SET nama=$1, email=$2, no_anggota=$3, tanggal_lahir=$4, alamat=$5, no_hp=$6 WHERE id=$7";
        pg_query_params($conn, $query, array($nama, $email, $no_anggota, $tgl, $alamat, $no_hp, $id));
        pg_close($conn);
    }

    header('Location: list.php');
    exit;
}
?>