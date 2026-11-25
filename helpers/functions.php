<?php
function e(string $nilai): string {
    return htmlspecialchars($nilai, ENT_QUOTES, 'UTF-8');
}

function formatRupiah(float $angka): string {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

function hitungDiskon(float $harga, float $persen = 10): float {
    return $harga * ($persen / 100);
}

function validasiEmail(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function ringkasTeks(string $teks, int $maksimal = 30): string {
    if (strlen($teks) <= $maksimal) {
        return $teks;
    }
    return substr($teks, 0, $maksimal) . '...';
}

function isActive(string $targetPage, string $currentPage): string {
    return $targetPage === $currentPage ? 'class="active"' : '';
}

function isLoggedIn(): bool {
    return !empty($_SESSION['user']);
}