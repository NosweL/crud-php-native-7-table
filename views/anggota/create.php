<?php
require_once './../../koneksi.php';
require_once './../../models/Anggota.php';

$namaError = '';
$teleponError = '';

$nama = '';
$telepon = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $jenisKelamin = $_POST['jenis_kelamin'];
    $tanggalLahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];

    // Validasi kolom nama (hanya karakter huruf dan spasi)
    if (!preg_match('/^[A-Za-z ]+$/', $nama)) {
        $namaError = 'Kolom nama hanya dapat diisi dengan huruf dan spasi.';
    }

    // Validasi kolom telepon (hanya angka)
    if (!ctype_digit($telepon)) {
        $teleponError = 'Kolom telepon hanya dapat diisi dengan angka.';
    }

    if (empty($namaError) && empty($teleponError)) {
        $anggotaModel = new Anggota($conn);
        $result = $anggotaModel->tambahAnggota($nama, $jenisKelamin, $tanggalLahir, $alamat, $telepon);

        if ($result) {
            header('Location: index.php');
            exit();
        } else {
            echo 'Gagal menambahkan anggota.';
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Tambah Anggota Baru</title>
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
        input[type="date"],
        select,
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
    </style>
</head>

<body>
    <h1>Tambah Anggota Baru</h1>

    <form method="POST" action="">
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?php echo htmlspecialchars($nama); ?>" required><br>
        <div style="color: red;"><?php echo $namaError; ?></div><br>

        <label>Jenis Kelamin:</label><br>
        <select name="jenis_kelamin" required>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select><br><br>

        <label>Tanggal Lahir:</label><br>
        <input type="date" name="tanggal_lahir" required><br><br>

        <label>Alamat:</label><br>
        <textarea name="alamat" required></textarea><br><br>

        <label>Telepon:</label><br>
        <input type="text" name="telepon" value="<?php echo htmlspecialchars($telepon); ?>" required><br>
        <div style="color: red;"><?php echo $teleponError; ?></div><br>

        <div class="button-group">
            <input type="submit" value="Simpan">
            <a href="index.php">Kembali</a>
        </div>
    </form>
</body>

</html>