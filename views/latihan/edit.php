<?php
require_once './../../koneksi.php';
require_once './../../models/Latihan.php';

$id = $_GET['id'];

$latihanModel = new Latihan($conn);
$latihan = $latihanModel->getLatihanById($id);

if (empty($latihan)) {
    echo 'Latihan tidak ditemukan.';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $nama_alat = $_POST['nama_alat'];

    $result = $latihanModel->updateLatihan($id, $nama, $deskripsi, $nama_alat);

    if ($result) {
        header('Location: index.php');
        exit();
    } else {
        echo 'Gagal mengupdate latihan.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Latihan</title>
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

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Edit Latihan</h1>

    <?php if (isset($errorMessage)) { ?>
        <p class="error-message"><?php echo $errorMessage; ?></p>
    <?php } ?>

    <form method="POST" action="">
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?php echo $latihan['nama']; ?>" required><br><br>

        <label>Deskripsi:</label><br>
        <textarea name="deskripsi" required><?php echo $latihan['deskripsi']; ?></textarea><br><br>

        <label>Nama Alat:</label><br>
        <input type="text" name="nama_alat" value="<?php echo $latihan['nama_alat']; ?>" required><br><br>

        <div class="button-group">
            <a href="index.php">Kembali</a>
            <input type="submit" value="Update">
        </div>
    </form>
</body>
</html>
