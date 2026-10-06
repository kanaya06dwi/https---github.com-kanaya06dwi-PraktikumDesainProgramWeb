<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tambah.php');
    exit;
}
$no_anggota = trim($_POST['no_anggota'] ?? '');
$nama       = trim($_POST['nama'] ?? '');
$alamat     = trim($_POST['alamat'] ?? '');
$no_hp      = trim($_POST['no_hp'] ?? '');
$errors = [];
if ($no_anggota === '') {
    $errors[] = "Nomor Anggota wajib diisi.";
}
if ($nama === '') {
    $errors[] = "Nama Anggota wajib diisi.";
}
if ($alamat === '') {
    $errors[] = "Alamat wajib diisi.";
} elseif (strlen($alamat) < 5) {
    $errors[] = "Alamat terlalu singkat (minimal 5 karakter).";
}
if ($no_hp === '') {
    $errors[] = "Nomor HP wajib diisi.";
} elseif (!preg_match('/^[0-9]{10,13}$/', $no_hp)) {
    $errors[] = "Nomor HP harus berupa angka 10-13 digit.";
}
if (!empty($errors)) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => implode(' ', $errors)
    ];
    header('Location: tambah.php');
    exit;
}
if (!isset($_SESSION['anggota'])) {
    $_SESSION['anggota'] = [];
}
$_SESSION['anggota'][] = [
    'no_anggota' => $no_anggota,
    'nama'       => $nama,
    'alamat'     => $alamat,
    'no_hp'      => $no_hp
];
$_SESSION['flash'] = [
    'type' => 'success',
    'pesan' => 'Anggota berhasil ditambahkan.'
];

header('Location: list.php');
exit;