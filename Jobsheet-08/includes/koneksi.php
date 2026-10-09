<?php
$conn_string = "host=127.0.0.1 port=5432 dbname=simpus_mini user=postgres password=postgres";
$conn = pg_connect($conn_string);

if (!$conn) {
    die("Koneksi PostgreSQL Gagal: Cek apakah service PostgreSQL di Laragon sudah Start.");
}
?>