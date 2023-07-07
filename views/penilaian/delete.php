<?php
require_once './../../koneksi.php';
require_once './../../models/Penilaian.php';

$id = $_GET['id'];

$penilaianModel = new Penilaian($conn);
$result = $penilaianModel->hapusPenilaian($id);

if ($result) {
    header('Location: index.php');
    exit();
} else {
    echo 'Gagal menghapus penilaian.';
}
?>
