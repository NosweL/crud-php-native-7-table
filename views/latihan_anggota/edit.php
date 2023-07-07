<?php
require_once './../../koneksi.php';
require_once './../../models/Latihan_Anggota.php';
require_once './../../models/Anggota.php';
require_once './../../models/Latihan.php';

$id = $_GET['id'];

$latihanAnggotaModel = new Latihan_Anggota($conn);
$anggotaModel = new Anggota($conn);
$latihanModel = new Latihan($conn);

$latihanAnggota = $latihanAnggotaModel->getLatihanAnggotaById($id);

if (empty($latihanAnggota)) {
    echo 'Latihan Anggota tidak ditemukan.';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_anggota = $_POST['id_anggota'];
    $id_latihan = $_POST['id_latihan'];
    $hari = $_POST['hari'];

    $anggota = $anggotaModel->getAnggotaById($id_anggota);
    $latihan = $latihanModel->getLatihanById($id_latihan);

    if ($anggota && $latihan) {
        $result = $latihanAnggotaModel->updateLatihanAnggota($id, $id_anggota, $id_latihan, $hari);

        if ($result) {
            header('Location: index.php');
            exit();
        } else {
            $errorMessage = 'Gagal mengupdate latihan anggota.';
        }
    } else {
        $errorMessage = 'Anggota atau latihan tidak ditemukan.';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Latihan Anggota</title>
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
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        select {
            height: 30px;
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
            border-radius: 20px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
            flex: 1;
            text-align: center;
            margin-right: 5px;
        }

        input[type="submit"]:hover,
        a:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h1>Edit Latihan Anggota</h1>

    <?php if (isset($errorMessage)) { ?>
        <p class="error-message"><?php echo $errorMessage; ?></p>
    <?php } ?>

    <form method="POST" action="">
        <label>Anggota:</label><br>
        <select name="id_anggota" required>
            <?php
            $anggotaModel = new Anggota($conn);
            $anggotaList = $anggotaModel->getAllAnggota();
            foreach ($anggotaList as $anggota) {
                $selected = ($anggota['id_anggota'] == $latihanAnggota['id_anggota']) ? 'selected' : '';
                echo '<option value="' . $anggota['id_anggota'] . '" ' . $selected . '>' . $anggota['nama'] . '</option>';
            }
            ?>
        </select><br><br>

        <label>Latihan:</label><br>
        <select name="id_latihan" required>
            <?php
            $latihanModel = new Latihan($conn);
            $latihanList = $latihanModel->getAllLatihan();
            foreach ($latihanList as $latihan) {
                $selected = ($latihan['id_latihan'] == $latihanAnggota['id_latihan']) ? 'selected' : '';
                echo '<option value="' . $latihan['id_latihan'] . '" ' . $selected . '>' . $latihan['nama'] . '</option>';
            }
            ?>
        </select><br><br>

        <label>Hari:</label><br>
        <select name="hari">
            <option value="Senin" <?php if ($latihanAnggota['hari'] === 'Senin') echo 'selected'; ?>>Senin</option>
            <option value="Selasa" <?php if ($latihanAnggota['hari'] === 'Selasa') echo 'selected'; ?>>Selasa</option>
            <option value="Rabu" <?php if ($latihanAnggota['hari'] === 'Rabu') echo 'selected'; ?>>Rabu</option>
            <option value="Kamis" <?php if ($latihanAnggota['hari'] === 'Kamis') echo 'selected'; ?>>Kamis</option>
            <option value="Jumat" <?php if ($latihanAnggota['hari'] === 'Jumat') echo 'selected'; ?>>Jumat</option>
        </select><br><br>

        <div class="button-group">
            <input class="button" type="submit" value="Update">
            <a class="button-batal" href="index.php">Kembali</a>
        </div>
    </form>
</body>

</html>