<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $kategori = trim($_POST['kategori']);
    $harga_jual = (float)$_POST['harga_jual'];
    $harga_beli = (float)$_POST['harga_beli'];
    $stok = (int)$_POST['stok'];
    $gambar = '';

    if (!empty($_FILES['file_gambar']['name']) && $_FILES['file_gambar']['error'] === 0) {
        $filename = time() . '_' . str_replace(' ', '_', basename($_FILES['file_gambar']['name']));
        $targetDir = __DIR__ . '/../../assets/gambar/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        if (move_uploaded_file($_FILES['file_gambar']['tmp_name'], $targetDir . $filename)) {
            $gambar = $filename;
        }
    }

    $stmt = mysqli_prepare($conn, "INSERT INTO data_barang (nama, kategori, harga_jual, harga_beli, stok, gambar) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssddis", $nama, $kategori, $harga_jual, $harga_beli, $stok, $gambar);
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Data barang berhasil ditambahkan.'];
        header('Location: ' . BASE_URL . '/barang/list');
        exit;
    } else {
        $_SESSION['flash'] = ['type' => 'error', 'message' => 'Gagal menambahkan data barang.'];
    }
}
?>
<section class="content">
    <h2>Tambah Barang</h2>
    <form method="post" action="<?= BASE_URL ?>/barang/add" enctype="multipart/form-data" class="form-box">
        <label>Nama Barang</label>
        <input type="text" name="nama" required>

        <label>Kategori</label>
        <select name="kategori">
            <option value="Komputer">Komputer</option>
            <option value="Elektronik">Elektronik</option>
            <option value="Hand Phone">Hand Phone</option>
        </select>

        <label>Harga Jual</label>
        <input type="number" name="harga_jual" required>

        <label>Harga Beli</label>
        <input type="number" name="harga_beli" required>

        <label>Stok</label>
        <input type="number" name="stok" required>

        <label>File Gambar</label>
        <input type="file" name="file_gambar" accept="image/*">

        <div class="form-actions">
            <button type="submit" class="btn">Simpan</button>
            <a href="<?= BASE_URL ?>/barang/list" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</section>