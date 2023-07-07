<?php
require_once './../../koneksi.php';
require_once './../../models/Suplemen.php';

$id = $_GET['id'];

$suplemenModel = new Suplemen($conn);
$result = $suplemenModel->hapusSuplemen($id);

if ($result) {
    header('Location: index.php');
    exit();
} else {
    echo 'Gagal menghapus suplemen.';
}
?>
