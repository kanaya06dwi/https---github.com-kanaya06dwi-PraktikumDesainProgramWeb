<?php
session_start();
$_jobsheetRoot = dirname(__DIR__);
$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
$_rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($_jobsheetRoot))), '/');
$base = $_rel === '' ? '' : str_repeat('../', substr_count($_rel, '/') + 1);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMPUS-Mini<?php echo isset($page_title) ? ' | ' . $page_title : ''; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/style.css">
</head>
<body class="bg-light">
<header class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="<?php echo $base; ?>index.php">SIMPUS-Mini</a>
        <button type="button" id="nav-toggle-btn" class="navbar-toggler" aria-label="Menu">&#9776;</button>
        <nav class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>index.php">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>buku/list.php">Daftar Buku</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>buku/tambah.php">Tambah Buku</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>anggota/list.php">Daftar Anggota</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo $base; ?>anggota/tambah.php">Tambah Anggota</a></li>
            </ul>
        </nav>
    </div>
</header>
<main class="container my-4">