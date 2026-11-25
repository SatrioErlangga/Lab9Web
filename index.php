<?php
session_start();
ob_start();

define('BASE_URL', '/Lab9Web');

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/helpers/functions.php';

// Whitelist rute lengkap
$routes = [
    'dashboard'     => __DIR__ . '/views/dashboard.php',
    'profil'        => __DIR__ . '/views/profil.php',
    'kontak'        => __DIR__ . '/views/kontak.php',
    'auth/login'    => __DIR__ . '/modules/auth/login.php',
    'auth/logout'   => __DIR__ . '/modules/auth/logout.php',
    'barang/list'   => __DIR__ . '/modules/barang/list.php',
    'barang/add'    => __DIR__ . '/modules/barang/add.php',
    'barang/edit'   => __DIR__ . '/modules/barang/edit.php',
    'barang/delete' => __DIR__ . '/modules/barang/delete.php',
];

// Rute yang wajib login
$protectedRoutes = [
    'barang/list',
    'barang/add',
    'barang/edit',
    'barang/delete',
];

$page = $_GET['page'] ?? 'dashboard';
$page = trim($page, '/');
if ($page === '' || $page === 'home') {
    $page = 'dashboard';
}

// Validasi whitelist
if (!is_string($page) || !array_key_exists($page, $routes)) {
    http_response_code(404);
    $contentFile = __DIR__ . '/views/404.php';
} else {
    // Cek autentikasi untuk rute terproteksi
    if (in_array($page, $protectedRoutes, true) && !isLoggedIn()) {
        $_SESSION['flash'] = [
            'type'    => 'error',
            'message' => 'Silakan login terlebih dahulu untuk mengakses Data Barang.'
        ];
        header('Location: ' . BASE_URL . '/auth/login');
        exit;
    }
    $contentFile = $routes[$page];
}

// Aksi tanpa render layout HTML
if (in_array($page, ['auth/logout', 'barang/delete'], true)) {
    require $contentFile;
    exit;
}

require_once __DIR__ . '/views/header.php';
require $contentFile;
require_once __DIR__ . '/views/footer.php';

ob_end_flush();