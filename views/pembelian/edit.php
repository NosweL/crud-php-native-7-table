<?php
require_once './../../koneksi.php';
require_once './../../models/Pembelian.php';
require_once './../../models/Anggota.php';
require_once './../../models/Suplemen.php';

$id = $_GET['id'];

$pembelianModel = new Pembelian($conn);
$anggotaModel = new Anggota($conn);
$suplemenModel = new Suplemen($conn);

$pembelian = $pembelianModel->getPembelianById($id);
$anggotaList = $anggotaModel->getAllAnggota();
$suplemenList = $suplemenModel->getAllSuplemen();

if (empty($pembelian)) {
    echo 'Pembelian tidak ditemukan.';
    exit();
}

// Jumlah stok awal sebelum diedit
$stokAwal = $pembelian['jumlah'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_anggota = $_POST['id_anggota'];
    $id_suplemen = $_POST['id_suplemen'];
    $tanggal_pembelian = $_POST['tanggal_pembelian'];
    $jumlah = $_POST['jumlah'];

    // Mendapatkan stok suplemen berdasarkan id_suplemen
    $suplemen = $suplemenModel->getSuplemenById($id_suplemen);
    $stok = $suplemen['stok'];

    // Mengembalikan stok yang diedit sebelum dikurangi
    $stok += $stokAwal;

    // Memeriksa apakah jumlah pembelian melebihi stok
    if ($jumlah > $stok) {
        echo '<script>alert("Stok suplemen tidak mencukupi.");</script>';
    } else {
        // Mengurangi stok berdasarkan jumlah baru
        $stok -= $jumlah;

        $result = $pembelianModel->updatePembelian($id, $id_anggota, $id_suplemen, $tanggal_pembelian, $jumlah);

        if ($result) {
            // Update stok suplemen setelah berhasil mengubah pembelian
            $suplemenModel->updateStokSuplemen($id_suplemen, $stok);

            header('Location: index.php');
            exit();
        } else {
            echo 'Gagal mengupdate pembelian.';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pembelian</title>
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
        input[type="date"],
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
            flex: 1;
            text-align: center;
            margin-right: 5px;
        }

        input[type="submit"]:hover,
        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Edit Pembelian</h1>

    <form method="POST" action="edit.php?id=<?php echo $id; ?>">
    <label>Anggota:</label><br>
    <select name="id_anggota" required>
        <?php foreach ($anggotaList as $anggota) { ?>
            <option value="<?php echo $anggota['id_anggota']; ?>" <?php if ($anggota['id_anggota'] === $pembelian['id_anggota']) { echo 'selected'; } ?>><?php echo $anggota['nama']; ?></option>
        <?php } ?>
    </select><br><br>

    <label>Suplemen:</label><br>
    <select name="id_suplemen" required>
        <?php foreach ($suplemenList as $suplemen) { ?>
            <option value="<?php echo $suplemen['id_suplemen']; ?>" <?php if ($suplemen['id_suplemen'] === $pembelian['id_suplemen']) { echo 'selected'; } ?>><?php echo $suplemen['nama']; ?></option>
        <?php } ?>
    </select><br><br>

    <label>Tanggal Pembelian:</label><br>
    <input type="date" name="tanggal_pembelian" value="<?php echo $pembelian['tanggal_pembelian']; ?>" required><br><br>

    <label>Jumlah:</label><br>
    <input type="number" name="jumlah" value="<?php echo $pembelian['jumlah']; ?>" required><br><br>

    <div class="button-group">
        <input type="submit" value="Update">
        <a href="index.php">Kembali</a>
    </div>
</form>
</body>
</html>
