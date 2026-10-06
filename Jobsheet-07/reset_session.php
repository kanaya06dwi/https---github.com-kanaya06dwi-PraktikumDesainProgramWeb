<?php
session_start();
session_unset();
session_destroy();

session_start();
$_SESSION['flash'] = [
    'type' => 'success',
    'pesan' => 'Seluruh data session berhasil dikosongkan.'
];

header('Location: index.php');
exit;