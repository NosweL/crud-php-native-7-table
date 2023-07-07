<?php
require_once './../../koneksi.php';
require_once './../../models/Jadwal_Latihan.php';
require_once './../../models/Latihan.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_latihan = $_POST['id_latihan'];
    $hari = $_POST['hari'];
    $jam = $_POST['jam'];

    $jadwalLatihanModel = new Jadwal_Latihan($conn);
    $result = $jadwalLatihanModel->tambahJadwalLatihan($id_latihan, $hari, $jam);

    if ($result) {
        header('Location: index.php');
        exit();
    } else {
        echo 'Gagal menambahkan jadwal latihan.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Jadwal Latihan Baru</title>
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

        input[type="number"],
        input[type="time"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="submit"],
        a.button-batal {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
            flex: 1;
            text-align: center;
            margin-right: 5px;
        }

        input[type="submit"]:hover,
        a.button-batal:hover {
            background-color: #45a049;
        }

        a.button-batal {
            background-color: red;
        }
    </style>
</head>
<body>
    <h1>Tambah Jadwal Latihan Baru</h1>

    <form method="POST" action="">
        <label>Nama Latihan:</label><br>
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
        <select name="hari" required>
            <option value="Senin">Senin</option>
            <option value="Selasa">Selasa</option>
            <option value="Rabu">Rabu</option>
            <option value="Kamis">Kamis</option>
            <option value="Jumat">Jumat</option>
        </select><br><br>

        <label>Jam:</label><br>
        <input type="time" name="jam" required><br><br>

        <div class="button-group">
            <input type="submit" value="Simpan">
            <a href="index.php" class="button-batal">Batal</a>
        </div>
    </form>
</body>
</html>
