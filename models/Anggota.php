<?php

class Anggota {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Fungsi untuk mengambil semua anggota
    public function getAllAnggota() {
        $sql = "SELECT * FROM Anggota";
        $result = $this->conn->query($sql);
        $anggota = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $anggota[] = $row;
            }
        }

        return $anggota;
    }
    public function getAnggotaById($id) {
        $sql = "SELECT * FROM Anggota WHERE id_anggota = '$id'";
        $result = $this->conn->query($sql);

        if ($result->num_rows === 1) {
            return $result->fetch_assoc(); // Return a single row
        } else {
            return null;
        }
    }

    // Fungsi untuk menambahkan anggota baru
    public function tambahAnggota($nama, $jenis_kelamin, $tanggal_lahir, $alamat, $telepon) {
        $sql = "INSERT INTO Anggota (nama, jenis_kelamin, tanggal_lahir, alamat, telepon)
                VALUES ('$nama', '$jenis_kelamin', '$tanggal_lahir', '$alamat', '$telepon')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Fungsi untuk mengupdate data anggota
    public function updateAnggota($id_anggota, $nama, $jenis_kelamin, $tanggal_lahir, $alamat, $telepon) {
        $sql = "UPDATE Anggota SET nama='$nama', jenis_kelamin='$jenis_kelamin', tanggal_lahir='$tanggal_lahir',
                alamat='$alamat', telepon='$telepon' WHERE id_anggota='$id_anggota'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Fungsi untuk menghapus anggota
    public function hapusAnggota($id_anggota) {
        // Delete associated records in the Pembelian table
        $deleteRecordsQuery = "DELETE FROM Pembelian WHERE id_anggota='$id_anggota'";
        $this->conn->query($deleteRecordsQuery);
    
        // Delete the Anggota record
        $sql = "DELETE FROM Anggota WHERE id_anggota='$id_anggota'";
    
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
?>
