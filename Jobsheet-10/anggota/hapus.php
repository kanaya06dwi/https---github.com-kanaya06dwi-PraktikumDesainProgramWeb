<?php
session_start();
require_once __DIR__ . '/../includes/koneksi.php';
require_once __DIR__ . '/../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

$id = $_POST['id'] ?? null;
if ($id && $conn) {
    $query = "DELETE FROM anggota WHERE id = $1";
    pg_query_params($conn, $query, array($id));
    pg_close($conn);
}

header('Location: list.php');
exit;
?>