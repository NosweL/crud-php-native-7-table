<?php
require_once './../../koneksi.php';
require_once './../../models/Latihan.php';

$id = $_GET['id'];

$latihanModel = new Latihan($conn);
$result = $latihanModel->hapusLatihan($id);

if ($result) {
    header('Location: index.php');
    exit();
} else {
    echo 'Gagal menghapus latihan.';
}
?>
