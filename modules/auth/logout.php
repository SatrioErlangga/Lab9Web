<?php
unset($_SESSION['user']);
$_SESSION['flash'] = [
    'type'    => 'success',
    'message' => 'Anda telah berhasil logout.'
];
header('Location: ' . BASE_URL . '/auth/login');
exit;