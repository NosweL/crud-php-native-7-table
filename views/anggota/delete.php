<?php
require_once './../../koneksi.php';
require_once './../../models/Anggota.php';

$id = $_GET['id'];

$anggotaModel = new Anggota($conn);
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
