<?php
require_once './../../koneksi.php';
require_once './../../models/Jadwal_Latihan.php';

$id = $_GET['id'];

$jadwalLatihanModel = new Jadwal_Latihan($conn);
$result = $jadwalLatihanModel->hapusJadwalLatihan($id);

if ($result) {
    header('Location: index.php');
    exit();
} else {
    echo 'Gagal menghapus jadwal latihan.';
}
?>
