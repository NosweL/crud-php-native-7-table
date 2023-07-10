<?php
require_once './../../koneksi.php';
require_once './../../models/Anggota.php';

$model = new Anggota($conn);



$namaError = '';
$teleponError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted form data
    $id_anggota = $_GET['id'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
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
        // Update the anggota data
        $success = $model->updateAnggota($id_anggota, $nama, $jenis_kelamin, $tanggal_lahir, $alamat, $telepon);

        if ($success) {
            // Redirect to the index.php page after successful update
            header("Location: index.php");
            exit();
        } else {
            // Handle the case when the update fails
            // For example, you can display an error message
            $errorMessage = "Update failed. Please try again.";
        }
    }
}

$id_anggota = $_GET['id'];
$anggota = $model->getAnggotaById($id_anggota);

if (empty($anggota)) {
    // Handle the case when the anggota data is not found
    // For example, you can redirect the user or display an error message
    $errorMessage = "Anggota not found.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Anggota</title>
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
            text-align: center;
        }
        .button-batal {
            background-color: red;
        }
    </style>
</head>

<body>
    <h1>Edit Anggota</h1>

    <form method="POST" action="">
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?php echo isset($anggota['nama']) ? htmlspecialchars($anggota['nama']) : ''; ?>" required><br>
        <?php if (!empty($namaError)) { ?>
            <p class="error-message"><?php echo $namaError; ?></p>
        <?php } ?>

        <label>Jenis Kelamin:</label><br>
        <select name="jenis_kelamin" required>
            <option value="Laki-laki" <?php if (isset($anggota['jenis_kelamin']) && $anggota['jenis_kelamin'] === 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
            <option value="Perempuan" <?php if (isset($anggota['jenis_kelamin']) && $anggota['jenis_kelamin'] === 'Perempuan') echo 'selected'; ?>>Perempuan</option>
        </select><br><br>

        <label>Tanggal Lahir:</label><br>
        <input type="date" name="tanggal_lahir" value="<?php echo isset($anggota['tanggal_lahir']) ? $anggota['tanggal_lahir'] : ''; ?>" required><br><br>

        <label>Alamat:</label><br>
        <textarea name="alamat" required><?php echo isset($anggota['alamat']) ? htmlspecialchars($anggota['alamat']) : ''; ?></textarea><br><br>

        <label>Telepon:</label><br>
        <input type="text" name="telepon" value="<?php echo isset($anggota['telepon']) ? htmlspecialchars($anggota['telepon']) : ''; ?>" required><br>
        <?php if (!empty($teleponError)) { ?>
            <p class="error-message"><?php echo $teleponError; ?></p>
        <?php } ?>

        <?php if (!empty($errorMessage)) { ?>
            <p class="error-message"><?php echo $errorMessage; ?></p>
        <?php } ?>

        <div class="button-group">
            <input class="button" type="submit" value="Update">
            <a class="button-batal" href="index.php">Batal</a>
        </div>
    </form>
</body>

</html>
