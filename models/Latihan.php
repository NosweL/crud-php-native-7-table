<?php
class Latihan {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Fungsi untuk mengambil semua latihan
    public function getAllLatihan() {
        $sql = "SELECT * FROM Latihan";
        $result = $this->conn->query($sql);
        $latihan = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $latihan[] = $row;
            }
        }

        return $latihan;
    }
    
    public function getLatihanById($id) {
        $sql = "SELECT * FROM Latihan WHERE id_latihan = '$id'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return null;
        }
    }

    // Fungsi untuk menambahkan latihan baru
    public function tambahLatihan($nama, $deskripsi, $nama_alat) {
        $sql = "INSERT INTO Latihan (nama, deskripsi, nama_alat) VALUES ('$nama', '$deskripsi', '$nama_alat')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Fungsi untuk mengupdate data latihan
    public function updateLatihan($id_latihan, $nama, $deskripsi, $nama_alat) {
        $sql = "UPDATE Latihan SET nama='$nama', deskripsi='$deskripsi', nama_alat='$nama_alat' WHERE id_latihan='$id_latihan'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Fungsi untuk menghapus latihan
    public function hapusLatihan($id_latihan) {
        $isUsed = $this->isLatihanUsed($id_latihan);

        if ($isUsed) {
            return false;
        }

        $sql = "DELETE FROM Latihan WHERE id_latihan='$id_latihan'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return 'Gagal menghapus latihan.';
        }
    }

    // Fungsi untuk memeriksa apakah latihan digunakan dalam jadwal latihan
    public function isLatihanUsed($id_latihan) {
        $sql = "SELECT * FROM Jadwal_Latihan WHERE id_latihan='$id_latihan'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function confirmDelete()
    {
        return "<script>
        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus latihan ini?');
        }
    </script>";
    }
}
