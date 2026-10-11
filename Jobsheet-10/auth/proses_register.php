<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = trim($_POST['nama'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($nama) || empty($username) || strlen($password) < 6) {
        $_SESSION['flash'] = ['pesan' => 'Lengkapi semua field. Password min 6 karakter.'];
        header('Location: register.php');
        exit;
    }

    require_once __DIR__ . '/../includes/koneksi.php';

    if ($conn) {
        // Cek username duplikat
        $cek = pg_query_params($conn, "SELECT id FROM users WHERE username = $1", array($username));
        if (pg_fetch_row($cek)) {
            $_SESSION['flash'] = ['pesan' => 'Username sudah digunakan.'];
            header('Location: register.php');
            exit;
        }

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert ke database
        $query = "INSERT INTO users (nama, username, password, role) VALUES ($1, $2, $3, 'petugas')";
        pg_query_params($conn, $query, array($nama, $username, $hashed_password));
        pg_close($conn);

        $_SESSION['flash_success'] = 'Registrasi berhasil, silakan login.';
        header('Location: login.php');
        exit;
    }
}
?>