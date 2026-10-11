<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPUS-Mini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        /* Navbar dengan warna Abu-abu Gelap (Dark Gray) */
        .navbar-custom {
            background-color: #4a5568 !important;
            padding: 12px 0;
        }
        .navbar-custom .navbar-brand {
            color: #ffffff !important;
            font-weight: 700;
            font-size: 1.3rem;
        }
        .navbar-custom .nav-link {
            color: #e2e8f0 !important;
            font-weight: 500;
            margin-left: 15px;
            font-size: 0.95rem;
        }
        .navbar-custom .nav-link:hover {
            color: #ffffff !important;
        }
        /* Kelas warna Abu-abu */
        .text-teal, .text-gray {
            color: #4a5568 !important;
        }
        .bg-teal, .bg-gray {
            background-color: #4a5568 !important;
            color: #ffffff !important;
        }
        .btn-teal, .btn-gray {
            background-color: #4a5568 !important;
            color: #ffffff !important;
            border: none;
        }
        .btn-teal:hover, .btn-gray:hover {
            background-color: #2d3748 !important;
            color: #ffffff !important;
        }
        .card-custom {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
            background: #ffffff;
        }
        .card-stat {
            background-color: #edf2f7;
            border-radius: 8px;
            padding: 20px;
        }
        .card-stat .stat-title {
            color: #4a5568;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .card-stat .stat-value {
            color: #2d3748;
            font-weight: 700;
            font-size: 2.2rem;
            margin-top: 5px;
        }
        .error-text {
            color: #e53e3e;
            font-size: 0.85rem;
            margin-top: 4px;
        }
    </style>
</head>
<body>

<?php
// Deteksi otomatis path halaman (subfolder atau root)
$in_subfolder = (strpos($_SERVER['SCRIPT_NAME'], '/buku/') !== false || strpos($_SERVER['SCRIPT_NAME'], '/anggota/') !== false);
$base_path = $in_subfolder ? '../' : './';
?>

<nav class="navbar navbar-expand-lg navbar-custom mb-4">
    <div class="container">
        <a class="navbar-brand" href="<?= $base_path ?>index.php">SIMPUS-Mini</a>
        <div class="navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="<?= $base_path ?>index.php">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $base_path ?>buku/list.php">Daftar Buku</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $base_path ?>buku/tambah.php">Tambah Buku</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $base_path ?>anggota/list.php">Daftar Anggota</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= $base_path ?>anggota/tambah.php">Tambah Anggota</a></li>
            </ul>
        </div>
    </div>
</nav>