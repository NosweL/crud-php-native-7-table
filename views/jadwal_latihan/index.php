<?php
// Include koneksi.php, Jadwal_Latihan.php, dan Latihan.php
require_once "./../../koneksi.php";
require_once "./../../models/Jadwal_Latihan.php";
require_once "./../../models/Latihan.php";

// Create a new instance of Jadwal_Latihan and pass the $conn object to the constructor
$jadwal_latihan = new Jadwal_Latihan($conn);

// Retrieve all jadwal latihan using the getAllJadwalLatihan() method
$jadwalLatihanList = $jadwal_latihan->getAllJadwalLatihan();

// Create a new instance of Latihan and pass the $conn object to the constructor
$latihanModel = new Latihan($conn);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Jadwal Latihan</title>
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
    <h1>Daftar Jadwal Latihan</h1>

    <table>
        <tr>
            <th>Nama Latihan</th>
            <th>Hari</th>
            <th>Jam</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($jadwalLatihanList as $jadwalLatihan) { ?>
            <tr>
                <td><?php echo $jadwalLatihan['nama']; ?></td>
                <td><?php echo $jadwalLatihan['hari']; ?></td>
                <td><?php echo $jadwalLatihan['jam']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $jadwalLatihan['id_jadwal']; ?>">Edit</a>
                    <a href="delete.php?id=<?php echo $jadwalLatihan['id_jadwal']; ?>">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <a href="create.php" style="background-color: #4CAF50;">Tambah Jadwal Latihan Baru</a>
    <a href="./../../index.php" style="background-color: #4CAF50;">Kembali</a>
</body>
</html>