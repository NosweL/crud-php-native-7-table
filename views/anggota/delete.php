<?php
require_once './../../koneksi.php';
require_once './../../models/Anggota.php';

$id = $_GET['id'];

$anggotaModel = new Anggota($conn);

// Pengecekan apakah data anggota digunakan di tabel lain
$isUsed = $anggotaModel->isAnggotaUsed($id);
if ($isUsed) {
    echo '<script>alert("Data anggota sedang digunakan di tabel lain."); 
    window.location.href = "index.php";</script>';
    exit();
}

$result = $anggotaModel->hapusAnggota($id);

if ($result) {
    // Menghapus anggota berhasil, lakukan penyesuaian ID anggota secara manual
    $resetIdQuery = "ALTER TABLE anggota AUTO_INCREMENT = 1";
    $conn->query($resetIdQuery);

    header('Location: index.php');
    exit();
} else {
    echo 'Gagal menghapus anggota.';
}
?>
