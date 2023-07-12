<?php
require_once './../../koneksi.php';
require_once './../../models/Penilaian.php';
require_once './../../models/Anggota.php';
require_once './../../models/Latihan.php';

$penilaianModel = new Penilaian($conn);
$penilaianList = $penilaianModel->getAllPenilaian();

$anggotaModel = new Anggota($conn);
$latihanModel = new Latihan($conn);

$confirmDeleteScript = $penilaianModel->confirmDelete();
echo $confirmDeleteScript;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Penilaian</title>
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
    <h1>Daftar Penilaian</h1>

    <table>
        <tr>
            <th>Nama Anggota</th>
            <th>Nama Latihan</th>
            <th>Nilai</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($penilaianList as $penilaian) {
            $anggota = $anggotaModel->getAnggotaById($penilaian['id_anggota']);
            $latihan = $latihanModel->getLatihanById($penilaian['id_latihan']);
        ?>
            <tr>
                <td><?php echo $anggota['nama']; ?></td>
                <td><?php echo $latihan['nama']; ?></td>
                <td><?php echo $penilaian['nilai']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $penilaian['id_penilaian']; ?>">Edit</a>
                    <a href="delete.php?id=<?php echo $penilaian['id_penilaian']; ?>"class="delete-link" onclick="return confirmDelete()">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <a href="create.php">Tambah Penilaian Baru</a>
    <a href="./../../index.php">Kembali</a>
</body>
</html>
