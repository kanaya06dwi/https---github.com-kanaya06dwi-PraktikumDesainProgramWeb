<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    require_once __DIR__ . '/../includes/koneksi.php';

    if ($conn) {
        $res = pg_query_params($conn, "SELECT * FROM users WHERE username = $1", array($username));
        $user = pg_fetch_assoc($res);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nama']    = $user['nama'];
            $_SESSION['role']    = $user['role'];

            header('Location: ../index.php');
            exit;
        }
    }

    $_SESSION['flash'] = ['pesan' => 'Username atau password salah.'];
    header('Location: login.php');
    exit;
}
?>