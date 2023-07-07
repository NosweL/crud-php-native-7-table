<?php
require_once './../../koneksi.php';
require_once './../../models/Penilaian.php';
require_once './../../models/Anggota.php';
require_once './../../models/Latihan.php';

$id = $_GET['id'];

$penilaianModel = new Penilaian($conn);
$anggotaModel = new Anggota($conn);
$latihanModel = new Latihan($conn);

$penilaian = $penilaianModel->getPenilaianById($id);

if (empty($penilaian)) {
    echo 'Penilaian tidak ditemukan.';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_anggota = $_POST['id_anggota'];
    $id_latihan = $_POST['id_latihan'];
    $nilai = $_POST['nilai'];

    $result = $penilaianModel->updatePenilaian($id, $id_anggota, $id_latihan, $nilai);

    if ($result) {
        header('Location: index.php');
        exit();
    } else {
        echo 'Gagal mengupdate penilaian.';
    }
}

$anggotaList = $anggotaModel->getAllAnggota();
$latihanList = $latihanModel->getAllLatihan();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Penilaian</title>
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
    <h1>Edit Penilaian</h1>

    <form method="POST" action="">
        <label>Anggota:</label><br>
        <select name="id_anggota" required>
            <?php foreach ($anggotaList as $anggota) { ?>
                <option value="<?php echo $anggota['id_anggota']; ?>" <?php if ($penilaian[0]['id_anggota'] == $anggota['id_anggota']) echo 'selected'; ?>>
                    <?php echo $anggota['nama']; ?>
                </option>
            <?php } ?>
        </select>

        <br><br>

        <label>Latihan:</label><br>
        <select name="id_latihan" required>
            <?php foreach ($latihanList as $latihan) { ?>
                <option value="<?php echo $latihan['id_latihan']; ?>" <?php if ($penilaian[0]['id_latihan'] == $latihan['id_latihan']) echo 'selected'; ?>>
                    <?php echo $latihan['nama']; ?>
                </option>
            <?php } ?>
        </select>

        <br><br>

        <label>Nilai:</label><br>
        <input type="number" name="nilai" value="<?php echo $penilaian[0]['nilai']; ?>" required><br><br>

        <div class="button-group">
            <input type="submit" value="Update">
            <a href="index.php">Kembali</a>
        </div>
    </form>
</body>
</html>
