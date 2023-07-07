<?php
class Suplemen {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Fungsi untuk mengambil semua suplemen
    public function getAllSuplemen() {
        $query = "SELECT * FROM suplemen";
        $result = $this->conn->query($query);
        $suplemenList = array();
    
        while ($row = $result->fetch_assoc()) {
            $suplemenList[] = $row;
        }
    
        return $suplemenList;
    }

    public function getSuplemenById($id) {
        $sql = "SELECT * FROM Suplemen WHERE id_suplemen = '$id'";
        $result = $this->conn->query($sql);

        if ($result->num_rows === 1) {
            return $result->fetch_assoc(); // Return a single row
        } else {
            return null;
        }
    }

    // Fungsi untuk menambahkan suplemen baru
    public function tambahSuplemen($nama, $harga, $stok) {
        $sql = "INSERT INTO Suplemen (nama, harga, stok) VALUES ('$nama', '$harga', '$stok')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Fungsi untuk mengupdate data suplemen
    public function updateSuplemen($id_suplemen, $nama, $harga, $stok) {
        $sql = "UPDATE Suplemen SET nama='$nama', harga='$harga', stok='$stok' WHERE id_suplemen='$id_suplemen'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Fungsi untuk menghapus suplemen
    public function hapusSuplemen($id_suplemen) {
        $sql = "DELETE FROM Suplemen WHERE id_suplemen='$id_suplemen'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
