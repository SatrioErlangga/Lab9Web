<?php
if (isLoggedIn()) {
    header('Location: ' . BASE_URL . '/dashboard');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === 'Satrio' && $password === 'Satrio123') {
        $_SESSION['user'] = [
            'username' => $username,
            'nama'     => 'Satrio Erlangga'
        ];
        $_SESSION['flash'] = [
            'type'    => 'success',
            'message' => 'Login berhasil! Selamat datang, ' . $username . '.'
        ];
        header('Location: ' . BASE_URL . '/barang/list');
        exit;
    } else {
        $_SESSION['flash'] = [
            'type'    => 'error',
            'message' => 'Username atau password salah.'
        ];
        header('Location: ' . BASE_URL . '/auth/login');
        exit;
    }
}
?>

<section class="content">
    <h2>Login Pengguna</h2>
    <p>Masuk untuk mengelola modul <strong>Data Barang</strong>.</p>
    <form method="post" action="<?= BASE_URL ?>/auth/login" class="form-box">
        <label>Username</label>
        <input type="text" name="username" placeholder="Satrio" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Satrio123" required>

        <button type="submit" class="btn">Login</button>
    </form>
</section>