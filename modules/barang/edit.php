<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = mysqli_prepare($conn, "SELECT * FROM data_barang WHERE id_barang = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$data) {
    echo '<p class="alert error">Data barang tidak ditemukan.</p>';
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $kategori = trim($_POST['kategori']);
    $harga_jual = (float)$_POST['harga_jual'];
    $harga_beli = (float)$_POST['harga_beli'];
    $stok = (int)$_POST['stok'];
    $gambar = $data['gambar'];

    if (!empty($_FILES['file_gambar']['name']) && $_FILES['file_gambar']['error'] === 0) {
        $filename = time() . '_' . str_replace(' ', '_', basename($_FILES['file_gambar']['name']));
        $targetDir = __DIR__ . '/../../assets/gambar/';
        if (move_uploaded_file($_FILES['file_gambar']['tmp_name'], $targetDir . $filename)) {
            $gambar = $filename;
        }
    }

    $stmtUpd = mysqli_prepare($conn, "UPDATE data_barang SET nama=?, kategori=?, harga_jual=?, harga_beli=?, stok=?, gambar=? WHERE id_barang=?");
    mysqli_stmt_bind_param($stmtUpd, "ssddisi", $nama, $kategori, $harga_jual, $harga_beli, $stok, $gambar, $id);
    if (mysqli_stmt_execute($stmtUpd)) {
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Data barang berhasil diperbarui.'];
        header('Location: ' . BASE_URL . '/barang/list');
        exit;
    }
}
?>
<section class="content">
    <h2>Ubah Barang</h2>
    <form method="post" action="<?= BASE_URL ?>/barang/edit?id=<?= $id ?>" enctype="multipart/form-data" class="form-box">
        <label>Nama Barang</label>
        <input type="text" name="nama" value="<?= e($data['nama']) ?>" required>

        <label>Kategori</label>
        <select name="kategori">
            <?php foreach (['Komputer', 'Elektronik', 'Hand Phone'] as $kat): ?>
                <option value="<?= $kat ?>" <?= $data['kategori'] === $kat ? 'selected' : '' ?>><?= $kat ?></option>
            <?php endforeach; ?>
        </select>

        <label>Harga Jual</label>
        <input type="number" name="harga_jual" value="<?= e($data['harga_jual']) ?>" required>

        <label>Harga Beli</label>
        <input type="number" name="harga_beli" value="<?= e($data['harga_beli']) ?>" required>

        <label>Stok</label>
        <input type="number" name="stok" value="<?= e($data['stok']) ?>" required>

        <label>Ganti Gambar (Opsional)</label>
        <input type="file" name="file_gambar" accept="image/*">

        <div class="form-actions">
            <button type="submit" class="btn">Simpan Perubahan</button>
            <a href="<?= BASE_URL ?>/barang/list" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</section>