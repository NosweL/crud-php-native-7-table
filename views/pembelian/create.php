<?php
require_once './../../koneksi.php';
require_once './../../models/Pembelian.php';
require_once './../../models/Anggota.php';
require_once './../../models/Suplemen.php';

$anggotaModel = new Anggota($conn);
$suplemenModel = new Suplemen($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_anggota = $_POST['id_anggota'];
    $id_suplemen = $_POST['id_suplemen'];
    $tanggal_pembelian = $_POST['tanggal_pembelian'];
    $jumlah = $_POST['jumlah'];

    // Mendapatkan stok suplemen berdasarkan id_suplemen
    $suplemen = $suplemenModel->getSuplemenById($id_suplemen);
    $stok = $suplemen['stok'];

    // Memeriksa apakah jumlah pembelian melebihi stok
    if ($jumlah > $stok) {
        echo '<script>alert("Stok suplemen tidak mencukupi.");</script>';
    } else {
        $pembelianModel = new Pembelian($conn);
        $result = $pembelianModel->tambahPembelian($id_anggota, $id_suplemen, $tanggal_pembelian, $jumlah);

        if ($result) {
            // Mengurangi stok suplemen setelah pembelian sukses
            $newStok = $stok - $jumlah;
            $suplemenModel->updateStokSuplemen($id_suplemen, $newStok);

            header('Location: index.php');
            exit();
        } else {
            echo 'Gagal menambahkan pembelian.';
        }
    }
}

$anggotaList = $anggotaModel->getAllAnggota();
$suplemenList = $suplemenModel->getAllSuplemen();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pembelian Baru</title>
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
    <h1>Tambah Pembelian Baru</h1>

    <form method="POST" action="">
        <label>Anggota:</label><br>
        <select name="id_anggota" required>
            <?php foreach ($anggotaList as $anggota) { ?>
                <option value="<?php echo $anggota['id_anggota']; ?>"><?php echo $anggota['nama']; ?></option>
            <?php } ?>
        </select><br><br>

        <label>Suplemen:</label><br>
        <select name="id_suplemen" required>
            <?php foreach ($suplemenList as $suplemen) { ?>
                <option value="<?php echo $suplemen['id_suplemen']; ?>"><?php echo $suplemen['nama']; ?></option>
            <?php } ?>
        </select><br><br>

        <label>Tanggal Pembelian:</label><br>
        <input type="date" name="tanggal_pembelian" required><br><br>

        <label>Jumlah:</label><br>
        <input type="number" name="jumlah" required><br><br>

        <div class="button-group">
           <input type="submit" value="Simpan">
            <a href="index.php">Kembali</a>
        </div>
    </form>
</body>
</html>
