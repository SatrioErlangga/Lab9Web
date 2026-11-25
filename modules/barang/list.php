<?php
$sql = 'SELECT * FROM data_barang ORDER BY id_barang DESC';
$result = mysqli_query($conn, $sql);
?>

<section class="content">
    <div class="header-action">
        <h2>Data Barang</h2>
        <a href="<?= BASE_URL ?>/barang/add" class="btn">+ Tambah Barang</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga Jual</th>
                <th>Harga Beli</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>
                            <?php if (!empty($row['gambar'])): ?>
                                <img src="<?= BASE_URL ?>/assets/gambar/<?= e($row['gambar']) ?>" alt="<?= e($row['nama']) ?>" width="60">
                            <?php else: ?>
                                <span>-</span>
                            <?php endif; ?>
                        </td>
                        <td><?= e(ringkasTeks($row['nama'], 25)) ?></td>
                        <td><?= e($row['kategori']) ?></td>
                        <td><?= formatRupiah((float)$row['harga_jual']) ?></td>
                        <td><?= formatRupiah((float)$row['harga_beli']) ?></td>
                        <td><?= (int)$row['stok'] ?></td>
                        <td class="aksi">
                            <a href="<?= BASE_URL ?>/barang/edit?id=<?= (int)$row['id_barang'] ?>" class="btn-sm">Ubah</a>
                            <form method="post" action="<?= BASE_URL ?>/barang/delete" class="form-hapus" style="display:inline;">
                                <input type="hidden" name="id_barang" value="<?= (int)$row['id_barang'] ?>">
                                <button type="submit" class="btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align:center;">Belum ada data barang.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>