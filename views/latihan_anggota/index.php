<?php
require_once './../../koneksi.php';
require_once './../../models/Latihan_Anggota.php';
require_once './../../models/Anggota.php';
require_once './../../models/Latihan.php';

$latihanAnggotaModel = new Latihan_Anggota($conn);
$anggotaModel = new Anggota($conn);
$latihanModel = new Latihan($conn);

$latihanAnggotaList = $latihanAnggotaModel->getAllLatihanAnggota();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Latihan Anggota</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f5f5f5;
        }

        a {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 10px;
        }

        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Daftar Latihan Anggota</h1>

    <table>
        <tr>
            <th>Anggota</th>
            <th>Latihan</th>
            <th>Hari</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($latihanAnggotaList as $latihanAnggota) {
            $id_anggota = $latihanAnggota['id_anggota'];
            $id_latihan = $latihanAnggota['id_latihan'];

            $anggota = $anggotaModel->getAnggotaById($id_anggota);
            $latihan = $latihanModel->getLatihanById($id_latihan);

            if ($anggota && $latihan) {
                $nama_anggota = $anggota['nama'];
                $nama_latihan = $latihan['nama'];
            } else {
                $nama_anggota = 'Tidak ditemukan';
                $nama_latihan = 'Tidak ditemukan';
            }
        ?>
            <tr>
                <td><?php echo $nama_anggota; ?></td>
                <td><?php echo $nama_latihan; ?></td>
                <td><?php echo $latihanAnggota['hari']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $latihanAnggota['id_latihan_anggota']; ?>">Edit</a>
                    <a href="delete.php?id=<?php echo $latihanAnggota['id_latihan_anggota']; ?>">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <a href="create.php">Tambah Latihan Anggota Baru</a>
    <a href="./../../index.php">Kembali</a>
</body>
</html>
