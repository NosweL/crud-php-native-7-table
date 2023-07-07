<?php
require_once './../../koneksi.php';
require_once './../../models/Pembelian.php';
require_once './../../models/Anggota.php';
require_once './../../models/Suplemen.php';

$pembelianModel = new Pembelian($conn);
$anggotaModel = new Anggota($conn);
$suplemenModel = new Suplemen($conn);

$pembelianList = $pembelianModel->getAllPembelian();
$anggotaList = $anggotaModel->getAllAnggota();
$suplemenList = $suplemenModel->getAllSuplemen();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pembelian</title>
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
    <h1>Daftar Pembelian</h1>

    <table>
        <tr>
            <th>Nama Anggota</th>
            <th>Nama Suplemen</th>
            <th>Tanggal Pembelian</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($pembelianList as $pembelian) {
            $anggota = $anggotaModel->getAnggotaById($pembelian['id_anggota']);
            $suplemen = $suplemenModel->getSuplemenById($pembelian['id_suplemen']);
        ?>
            <tr>
                <td><?php echo $anggota['nama']; ?></td>
                <td><?php echo $suplemen['nama']; ?></td>
                <td><?php echo $pembelian['tanggal_pembelian']; ?></td>
                <td><?php echo $pembelian['jumlah']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $pembelian['id_pembelian']; ?>">Edit</a>
                    <a href="delete.php?id=<?php echo $pembelian['id_pembelian']; ?>">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <a href="create.php">Tambah Pembelian Baru</a>
    <a href="./../../index.php">Kembali</a>
</body>
</html>
