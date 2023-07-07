<?php
require_once './../../koneksi.php';
require_once './../../models/Latihan_Anggota.php';
require_once './../../models/Anggota.php';
require_once './../../models/Latihan.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_anggota = $_POST['id_anggota'];
    $id_latihan = $_POST['id_latihan'];
    $hari = $_POST['hari'];

    $latihanAnggotaModel = new Latihan_Anggota($conn);
    $anggotaModel = new Anggota($conn);
    $latihanModel = new Latihan($conn);

    $anggota = $anggotaModel->getAnggotaById($id_anggota);
    $latihan = $latihanModel->getLatihanById($id_latihan);

    if ($anggota && $latihan) {
        $result = $latihanAnggotaModel->tambahLatihanAnggota($id_anggota, $id_latihan, $hari);

        if ($result) {
            header('Location: index.php');
            exit();
        } else {
            echo 'Gagal menambahkan latihan anggota.';
        }
    } else {
        echo 'Anggota atau latihan tidak ditemukan.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Latihan Anggota Baru</title>
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
        input[type="number"],
        select {
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
    <h1>Tambah Latihan Anggota Baru</h1>

    <form method="POST" action="">
        <label>Anggota:</label><br>
        <select name="id_anggota" required>
            <?php
            $anggotaModel = new Anggota($conn);
            $anggotaList = $anggotaModel->getAllAnggota();
            foreach ($anggotaList as $anggota) {
                echo '<option value="' . $anggota['id_anggota'] . '">' . $anggota['nama'] . '</option>';
            }
            ?>
        </select><br><br>

        <label>Latihan:</label><br>
        <select name="id_latihan" required>
            <?php
            $latihanModel = new Latihan($conn);
            $latihanList = $latihanModel->getAllLatihan();
            foreach ($latihanList as $latihan) {
                echo '<option value="' . $latihan['id_latihan'] . '">' . $latihan['nama'] . '</option>';
            }
            ?>
        </select><br><br>

        <label>Hari:</label><br>
        <select name="hari">
            <option value="Senin">Senin</option>
            <option value="Selasa">Selasa</option>
            <option value="Rabu">Rabu</option>
            <option value="Kamis">Kamis</option>
            <option value="Jumat">Jumat</option>
        </select><br><br>

        <div class="button-group">
            <input type="submit" value="Simpan">
            <a href="index.php">Kembali</a>
        </div>
    </form>
</body>
</html>

