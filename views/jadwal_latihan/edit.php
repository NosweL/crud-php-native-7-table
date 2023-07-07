<?php
require_once './../../koneksi.php';
require_once './../../models/Jadwal_Latihan.php';
require_once './../../models/Latihan.php';

$id = $_GET['id'];

$jadwalLatihanModel = new Jadwal_Latihan($conn);
$jadwalLatihan = $jadwalLatihanModel->getJadwalLatihanById($id);

if (empty($jadwalLatihan)) {
    echo 'Jadwal latihan tidak ditemukan.';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_latihan = $_POST['id_latihan'];
    $hari = $_POST['hari'];
    $jam = $_POST['jam'];

    $result = $jadwalLatihanModel->updateJadwalLatihan($id, $id_latihan, $hari, $jam);

    if ($result) {
        header('Location: index.php');
        exit();
    } else {
        echo 'Gagal mengupdate jadwal latihan.';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Jadwal Latihan</title>
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
        a {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
            width: 49%;
            text-align: center;
            margin-right: 5px;
        }

        input[type="submit"]:hover,
        a:hover {
            background-color: #45a049;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h1>Edit Jadwal Latihan</h1>

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
        <select name="hari">
            <option value="Senin" <?php if ($jadwalLatihan['hari'] === 'Senin') echo 'selected'; ?>>Senin</option>
            <option value="Selasa" <?php if ($jadwalLatihan['hari'] === 'Selasa') echo 'selected'; ?>>Selasa</option>
            <option value="Rabu" <?php if ($jadwalLatihan['hari'] === 'Rabu') echo 'selected'; ?>>Rabu</option>
            <option value="Kamis" <?php if ($jadwalLatihan['hari'] === 'Kamis') echo 'selected'; ?>>Kamis</option>
            <option value="Jumat" <?php if ($jadwalLatihan['hari'] === 'Jumat') echo 'selected'; ?>>Jumat</option>
        </select><br><br>

        <label>Jam:</label><br>
        <input type="time" name="jam" value="<?php echo $jadwalLatihan['jam'] ?? ''; ?>" required><br><br>

        <div class="button-group">
            <input type="submit" value="Update">
            <a href="index.php">Kembali</a>
        </div>
    </form>
</body>

</html>
