<?php
require_once './../../koneksi.php';
require_once './../../models/Suplemen.php';

$id = $_GET['id'];

$suplemenModel = new Suplemen($conn);

// Check if the suplemen is used
$isUsed = $suplemenModel->isSuplemenUsed($id);

if ($isUsed) {
    echo '<script>alert("Data Suplemen sedang digunakan dalam tabel Pembelian."); window.location.href = "index.php";</script>';
} else {
    $result = $suplemenModel->hapusSuplemen($id);

    if ($result === true) {
        echo '<script>alert("Suplemen berhasil dihapus."); window.location.href = "index.php";</script>';
    } else {
        echo '<script>alert("' . $result . '"); window.location.href = "index.php";</script>';
    }
}
?>
