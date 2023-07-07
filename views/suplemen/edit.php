<?php
require_once './../../koneksi.php';
require_once './../../models/Suplemen.php';

$id = $_GET['id'];

$suplemenModel = new Suplemen($conn);
$suplemen = $suplemenModel->getSuplemenById($id);

if (empty($suplemen)) {
    echo 'Suplemen tidak ditemukan.';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $result = $suplemenModel->updateSuplemen($id, $nama, $harga, $stok);

    if ($result) {
        header('Location: index.php');
        exit();
    } else {
        echo 'Gagal mengupdate suplemen.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Suplemen</title>
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

        .button-batal {
            background-color: red;
        }
    </style>
</head>
<body>
    <h1>Edit Suplemen</h1>

    <form method="POST" action="">
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?php echo $suplemen['nama']; ?>" required><br><br>

        <label>Harga:</label><br>
        <input type="number" name="harga" value="<?php echo $suplemen['harga']; ?>" required><br><br>

        <label>Stok:</label><br>
        <input type="number" name="stok" value="<?php echo $suplemen['stok']; ?>" required><br><br>

        <div class="button-group">
            <input type="submit" value="Update">
            <a href="index.php" class="button-batal">Batal</a>
        </div>
    </form>
</body>
</html>
