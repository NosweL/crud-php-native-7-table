<?php
require_once './../../koneksi.php';
require_once './../../models/Suplemen.php';

$suplemenModel = new Suplemen($conn);
$suplemenList = $suplemenModel->getAllSuplemen();

$confirmDeleteScript = $suplemenModel->confirmDelete();
echo $confirmDeleteScript;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Suplemen</title>
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
    <h1>Daftar Suplemen</h1>

    <table>
        <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($suplemenList as $suplemen) { ?>
            <tr>
                <td><?php echo $suplemen['nama']; ?></td>
                <td><?php echo $suplemenModel->formatRupiah($suplemen['harga']); ?></td>
                <td><?php echo $suplemen['stok']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $suplemen['id_suplemen']; ?>">Edit</a>
                    <a href="delete.php?id=<?php echo $suplemen['id_suplemen']; ?>"class="delete-link" onclick="return confirmDelete()">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <a href="create.php">Tambah Suplemen Baru</a>
    <a href="./../../index.php">Kembali</a>
</body>
</html>