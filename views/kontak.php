<?php
$pesanStatus = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    if (validasiEmail($email)) {
        $pesanStatus = '<p class="alert success">Email <strong>' . e($email) . '</strong> valid dan pesan berhasil dikirim!</p>';
    } else {
        $pesanStatus = '<p class="alert error">Format email tidak valid. Silakan periksa kembali.</p>';
    }
}
?>

<section class="content">
    <h2>Kontak Kami</h2>
    <?= $pesanStatus ?>
    <form method="post" action="<?= BASE_URL ?>/kontak" class="form-box">
        <label>Email Anda</label>
        <input type="text" name="email" placeholder="contoh@domain.com" required>

        <label>Pesan</label>
        <textarea name="pesan" rows="4" required></textarea>

        <div class="form-actions">
            <button type="submit" class="btn">Kirim Pesan</button>
            <a href="<?= BASE_URL ?>/dashboard" class="btn btn-secondary">Kembali ke Dashboard</a>
        </div>
    </form>
</section>