<?php
require_once './../../koneksi.php';
require_once './../../models/Latihan.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $nama_alat = $_POST['nama_alat'];

    $latihanModel = new Latihan($conn);
    $result = $latihanModel->tambahLatihan($nama, $deskripsi, $nama_alat);

    if ($result) {
        header('Location: index.php');
        exit();
    } else {
        echo 'Gagal menambahkan latihan.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Latihan Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        form {
            width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        input[type="submit"],
        a {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover,
        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Tambah Latihan Baru</h1>

    <form method="POST" action="">
        <label>Nama:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Repetisi:</label><br>
        <textarea name="deskripsi" required></textarea><br><br>

        <label>Nama Alat:</label><br>
        <input type="text" name="nama_alat" required><br><br>

        <div class="button-group">
            <input type="submit" value="Simpan">
            <a href="index.php">Kembali</a>
        </div>
    </form>
</body>
</html>
