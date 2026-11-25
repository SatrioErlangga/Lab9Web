<?php
$contohHarga = 2500000;
$diskon      = hitungDiskon($contohHarga, 15);
$hargaAkhir  = $contohHarga - $diskon;
?>
<section class="content">
    <h2>Halaman Home / Dashboard</h2>
    <p>Selamat datang di aplikasi PHP Modular. Seluruh halaman menggunakan template bersama, sistem routing <code>.htaccess</code>, dan proteksi sesi login untuk modul CRUD.</p>
    
    <div class="card">
        <h3>Demo Helper Function</h3>
        <p>Harga Awal: <strong><?= formatRupiah($contohHarga) ?></strong></p>
        <p>Diskon 15%: <strong><?= formatRupiah($diskon) ?></strong></p>
        <p>Harga Setelah Diskon: <strong><?= formatRupiah($hargaAkhir) ?></strong></p>
    </div>
</section>