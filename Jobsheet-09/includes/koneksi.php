<?php
$host     = "127.0.0.1";
$port     = "5432";
$dbname   = "simpus_mini";
$user     = "postgres";

// Daftar password yang umum di Laragon/PostgreSQL
$passwords = ['', 'postgres', 'root', 'admin'];
$conn = false;

foreach ($passwords as $pwd) {
    $conn_string = "host=$host port=$port dbname=$dbname user=$user password=$pwd";
    $conn = @pg_connect($conn_string);
    if ($conn) {
        break;
    }
}

// Jika semua password di atas gagal, coba hubungi tanpa nama database dulu untuk tes credential
if (!$conn) {
    echo "<b>Detail Error Koneksi PostgreSQL:</b><br>";
    $test_conn = pg_connect("host=$host port=$port user=$user password=postgres");
    if (!$test_conn) {
        echo pg_last_error();
    } else {
        echo "Password 'postgres' benar, tapi database 'simpus_mini' belum dibuat/ditemukan!";
    }
    exit;
}
?>