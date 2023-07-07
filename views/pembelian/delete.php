<?php
require_once './../../koneksi.php';
require_once './../../models/Pembelian.php';

$id = $_GET['id'];

$pembelianModel = new Pembelian($conn);
$result = $pembelianModel->hapusPembelian($id);

if ($result) {
    header('Location: index.php');
    exit();
} else {
    echo 'Gagal menghapus pembelian.';
}
?>
