<?php
require_once './../../koneksi.php';
require_once './../../models/Latihan.php';

$latihanModel = new Latihan($conn);
$latihanList = $latihanModel->getAllLatihan();

$confirmDeleteScript = $latihanModel->confirmDelete();
echo $confirmDeleteScript;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Latihan</title>
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
    <h1>Daftar Latihan</h1>

    <table>
        <tr>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Nama Alat</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($latihanList as $latihan) { ?>
            <tr>
                <td><?php echo $latihan['nama']; ?></td>
                <td><?php echo $latihan['deskripsi']; ?></td>
                <td><?php echo $latihan['nama_alat']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $latihan['id_latihan']; ?>">Edit</a>
                    <a href="delete.php?id=<?php echo $latihan['id_latihan']; ?>"class="delete-link" onclick="return confirmDelete()">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <a href="create.php">Tambah Latihan Baru</a>
    <a href="./../../index.php">Kembali</a>
</body>
</html>
