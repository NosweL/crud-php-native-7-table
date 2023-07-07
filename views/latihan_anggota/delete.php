<?php
require_once './../../koneksi.php';
require_once './../../models/Latihan_Anggota.php';

$id = $_GET['id'];

$latihanAnggotaModel = new Latihan_Anggota($conn);
$result = $latihanAnggotaModel->hapusLatihanAnggota($id);

if ($result) {
    header('Location: index.php');
    exit();
} else {
    echo 'Gagal menghapus latihan anggota.';
}
?>
