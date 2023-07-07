<?php
class Penilaian {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Fungsi untuk mengambil semua penilaian
    public function getAllPenilaian() {
        $sql = "SELECT * FROM Penilaian pl JOIN latihan l ON pl.id_latihan = l.id_latihan JOIN anggota ag ON pl.id_anggota = ag.id_anggota";
        $result = $this->conn->query($sql);
        $penilaian = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $penilaian[] = $row;
            }
        }

        return $penilaian;
    }
    public function getPenilaianById($id) {
        $sql = "SELECT * FROM Penilaian WHERE id_penilaian = '$id'";
        $result = $this->conn->query($sql);
        $penilaian = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $penilaian[] = $row;
            }
        }

        return $penilaian;
    }

    // Fungsi untuk menambahkan penilaian baru
    public function tambahPenilaian($id_anggota, $id_latihan, $nilai) {
        $sql = "INSERT INTO Penilaian (id_anggota, id_latihan, nilai) VALUES ('$id_anggota', '$id_latihan', '$nilai')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Fungsi untuk mengupdate data penilaian
    public function updatePenilaian($id_penilaian, $id_anggota, $id_latihan, $nilai) {
        $sql = "UPDATE Penilaian SET id_anggota='$id_anggota', id_latihan='$id_latihan',
                nilai='$nilai' WHERE id_penilaian='$id_penilaian'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Fungsi untuk menghapus penilaian
    public function hapusPenilaian($id_penilaian) {
        $sql = "DELETE FROM Penilaian WHERE id_penilaian='$id_penilaian'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}
?>
