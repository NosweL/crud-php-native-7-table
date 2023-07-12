<?php
require_once './../../koneksi.php';
require_once './../../models/Anggota.php';

$anggotaModel = new Anggota($conn);
$anggotaList = $anggotaModel->getAllAnggota();

$confirmDeleteScript = $anggotaModel->confirmDelete();
echo $confirmDeleteScript;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Anggota</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            background-image: url('./../../img/whitegym.jpg');
            background-repeat: no-repeat;
            background-size: cover;
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
    <h1>Daftar Anggota</h1>

    <table>
        <tr>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($anggotaList as $anggota) { ?>
            <tr>
                <td><?php echo $anggota['nama']; ?></td>
                <td><?php echo $anggota['jenis_kelamin']; ?></td>
                <td><?php echo $anggota['tanggal_lahir']; ?></td>
                <td><?php echo $anggota['alamat']; ?></td>
                <td><?php echo $anggota['telepon']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $anggota['id_anggota']; ?>">Edit</a>
                    <a href="delete.php?id=<?php echo $anggota['id_anggota']; ?>" class="delete-link" onclick="return confirmDelete()">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <a href="create.php">Tambah Anggota Baru</a>
    <a href="./../../index.php">Kembali</a>
</body>
</html>
