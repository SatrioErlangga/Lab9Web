<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_barang'])) {
    $id = (int)$_POST['id_barang'];
    $stmt = mysqli_prepare($conn, "DELETE FROM data_barang WHERE id_barang = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Data barang berhasil dihapus.'];
    } else {
        $_SESSION['flash'] = ['type' => 'error', 'message' => 'Gagal menghapus data barang.'];
    }
}

header('Location: ' . BASE_URL . '/barang/list');
exit;