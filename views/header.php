<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 9 - Aplikasi PHP Modular</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Aplikasi PHP Modular</h1>
        <p>Integrasi Template, Helper Function, Routing (.htaccess), Auth, dan CRUD Barang</p>
    </header>
    <nav>
        <a href="<?= BASE_URL ?>/dashboard" <?= isActive('dashboard', $page) ?>>Home</a>
        <a href="<?= BASE_URL ?>/barang/list" <?= isActive('barang/list', $page) ?>>Data Barang</a>
        <a href="<?= BASE_URL ?>/profil" <?= isActive('profil', $page) ?>>Profil</a>
        <a href="<?= BASE_URL ?>/kontak" <?= isActive('kontak', $page) ?>>Kontak</a>

        <div class="nav-auth">
            <?php if (isLoggedIn()): ?>
                <a href="<?= BASE_URL ?>/auth/logout" class="btn-logout">Logout (<?= e($_SESSION['user']['username']) ?>)</a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>/auth/login" <?= isActive('auth/login', $page) ?>>Login</a>
            <?php endif; ?>
        </div>
    </nav>
    <main>
        <?php if (!empty($_SESSION['flash'])): ?>
            <div class="alert <?= e($_SESSION['flash']['type']) ?>">
                <?= e($_SESSION['flash']['message']) ?>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>