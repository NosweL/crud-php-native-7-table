<?php
require_once "./../../koneksi.php";
require_once "./../../models/Penilaian.php";
require_once "./../../models/Anggota.php";
require_once "./../../models/Latihan.php";

$penilaianModel = new Penilaian($conn);
$anggotaModel = new Anggota($conn);
$latihanModel = new Latihan($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_anggota = $_POST["anggota"];
    $id_latihan = $_POST["latihan"];
    $nilai = $_POST["nilai"];

    // Memanggil metode tambahPenilaian() untuk menambahkan data baru
    if ($penilaianModel->tambahPenilaian($id_anggota, $id_latihan, $nilai)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menambahkan penilaian.";
    }
}

$anggotaList = $anggotaModel->getAllAnggota();
$latihanList = $latihanModel->getAllLatihan();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Tambah Penilaian Baru</title>
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

        select,
        input[type="number"] {
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
    <h1>Tambah Penilaian Baru</h1>

    <form action="" method="POST">
        <label for="anggota">Anggota:</label>
        <select name="anggota" id="anggota">
            <?php foreach ($anggotaList as $anggota) { ?>
                <option value="<?php echo $anggota['id_anggota']; ?>"><?php echo $anggota['nama']; ?></option>
            <?php } ?>
        </select>

        <br><br>

        <label for="latihan">Latihan:</label>
        <select name="latihan" id="latihan">
            <?php foreach ($latihanList as $latihan) { ?>
                <option value="<?php echo $latihan['id_latihan']; ?>"><?php echo $latihan['nama']; ?></option>
            <?php } ?>
        </select>

        <br><br>

        <label for="nilai">Nilai:</label>
        <input type="number" name="nilai" id="nilai" required>

        <br><br>

        <div class="button-group">
            <input type="submit" value="Tambah Penilaian">
            <a href="index.php">Kembali</a>
        </div>
    </form>
</body>
</html> 