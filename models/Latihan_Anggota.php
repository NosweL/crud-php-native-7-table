<?php
class Latihan_Anggota {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Fungsi untuk mengambil semua latihan anggota
    public function getAllLatihanAnggota() {
        $sql = "SELECT * FROM Latihan_Anggota lg JOIN latihan l ON lg.id_latihan = l.id_latihan JOIN anggota ag ON lg.id_anggota = ag.id_anggota";
        $result = $this->conn->query($sql);
        $latihan_anggota = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $latihan_anggota[] = $row;
            }
        }

        return $latihan_anggota;
    }

    public function getLatihanAnggotaById($id) {
        $sql = "SELECT * FROM Latihan_Anggota WHERE id_latihan_anggota = '$id'";
        $result = $this->conn->query($sql);
        $latihan_anggota = null; // Change to null instead of an empty array
    
        if ($result->num_rows > 0) {
            $latihan_anggota = $result->fetch_assoc(); // Fetch a single row
        }
    
        return $latihan_anggota;
    }

    // Fungsi untuk menambahkan latihan anggota baru
    public function tambahLatihanAnggota($id_anggota, $id_latihan, $hari) {
        $sql = "INSERT INTO Latihan_Anggota (id_anggota, id_latihan, hari)
                VALUES ('$id_anggota', '$id_latihan', '$hari')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Fungsi untuk mengupdate data latihan anggota
    public function updateLatihanAnggota($id_latihan_anggota, $id_anggota, $id_latihan, $hari) {
        $sql = "UPDATE Latihan_Anggota SET id_anggota='$id_anggota', id_latihan='$id_latihan',
                hari='$hari' WHERE id_latihan_anggota='$id_latihan_anggota'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Fungsi untuk menghapus latihan anggota
    public function hapusLatihanAnggota($id_latihan_anggota) {
        $sql = "DELETE FROM Latihan_Anggota WHERE id_latihan_anggota='$id_latihan_anggota'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
?>
