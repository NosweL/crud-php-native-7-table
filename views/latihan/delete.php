<?php
require_once './../../koneksi.php';
require_once './../../models/Latihan.php';

$id = $_GET['id'];

$latihanModel = new Latihan($conn);

// Check if the latihan is used in jadwal latihan
$isUsed = $latihanModel->isLatihanUsed($id);

if ($isUsed) {
    echo '<script>alert("Data Latihan sedang digunakan dalam jadwal latihan."); window.location.href = "index.php";</script>';
} else {
    $result = $latihanModel->hapusLatihan($id);

    if ($result === true) {
        echo '<script>alert("Latihan berhasil dihapus."); window.location.href = "index.php";</script>';
    } else {
        echo '<script>alert("' . $result . '"); window.location.href = "index.php";</script>';
    }
}
?>
