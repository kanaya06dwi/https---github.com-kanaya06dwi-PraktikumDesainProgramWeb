<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 3) {
        $_SESSION['flash'] = ['pesan' => 'Terlalu banyak percobaan gagal. Silakan coba lagi nanti.'];
        header('Location: login.php');
        exit;
    }

    require_once __DIR__ . '/../includes/koneksi.php';

    if ($conn) {
        $res = pg_query_params($conn, "SELECT * FROM users WHERE username = $1", array($username));
        $user = pg_fetch_assoc($res);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nama']    = $user['nama'];
            $_SESSION['role']    = $user['role'];

            unset($_SESSION['login_attempts']);

            if (isset($_POST['remember'])) {
                setcookie('remember_user', $user['id'], time() + (7 * 24 * 60 * 60), "/");
            }

            header('Location: ../index.php');
            exit;
        }
    }

    $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
    $_SESSION['flash'] = ['pesan' => 'Username atau password salah. Percobaan ke-' . $_SESSION['login_attempts'] . ' dari 3.'];
    header('Location: login.php');
    exit;
}
?>