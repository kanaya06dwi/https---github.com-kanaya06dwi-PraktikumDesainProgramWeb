<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

$page_title = "Login Petugas";
include '../includes/header.php';
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card card-custom p-4">
                <h4 class="text-teal fw-bold mb-3">Login Petugas</h4>

                <?php if (isset($_SESSION['flash_success'])): ?>
                    <div class="alert alert-success p-2 small">
                        <?= $_SESSION['flash_success'] ?>
                    </div>
                    <?php unset($_SESSION['flash_success']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['flash'])): ?>
                    <div class="alert alert-danger p-2 small">
                        <?= $_SESSION['flash']['pesan'] ?>
                    </div>
                    <?php unset($_SESSION['flash']); ?>
                <?php endif; ?>

                <form action="proses_login.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3 form-check">
    <input type="checkbox" name="remember" class="form-check-input" id="remember">
    <label class="form-check-label" for="remember">Ingat Saya</label>
</div>
                    <button type="submit" class="btn btn-teal w-100">Masuk</button>
                </form>
                <div class="mt-3 text-center small">
                    Belum punya akun? <a href="register.php">Daftar di sini</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>