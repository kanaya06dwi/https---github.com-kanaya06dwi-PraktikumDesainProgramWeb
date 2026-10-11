<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$sudahLogin = isset($_SESSION['user_id']);

// Hitung base path untuk relative links
$base = (strpos($_SERVER['SCRIPT_NAME'], '/buku/') !== false || 
         strpos($_SERVER['SCRIPT_NAME'], '/anggota/') !== false || 
         strpos($_SERVER['SCRIPT_NAME'], '/auth/') !== false) ? '../' : './';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'SIMPUS-Mini' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-teal navbar-dark">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= $base ?>index.php">SIMPUS-Mini</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="<?= $base ?>index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= $base ?>buku/list.php">Daftar Buku</a></li>
        
        <?php if ($sudahLogin): ?>
          <li class="nav-item"><a class="nav-link" href="<?= $base ?>buku/tambah.php">Tambah Buku</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $base ?>anggota/list.php">Daftar Anggota</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= $base ?>anggota/tambah.php">Tambah Anggota</a></li>
        <?php endif; ?>
      </ul>
      
      <div class="auth-status text-white">
        <?php if ($sudahLogin): ?>
          <span class="me-2">Halo, <strong><?= htmlspecialchars($_SESSION['nama']) ?></strong></span>
          <a href="<?= $base ?>auth/logout.php" class="btn btn-outline-light btn-sm">Logout</a>
        <?php else: ?>
          <a href="<?= $base ?>auth/login.php" class="btn btn-light btn-sm text-teal fw-bold">Login</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
<div class="py-4">