<?php
class Jadwal_Latihan {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Fungsi untuk mengambil semua jadwal latihan
    public function getAllJadwalLatihan() {
        $sql = "SELECT * FROM Jadwal_Latihan jl JOIN latihan l ON jl.id_latihan = l.id_latihan";
        $result = $this->conn->query($sql);
        $jadwal_latihan = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $jadwal_latihan[] = $row;
            }
        }

        return $jadwal_latihan;
    }
    public function getJadwalLatihanById($id) {
        $sql = "SELECT * FROM Jadwal_Latihan WHERE id_jadwal = '$id'";
        $result = $this->conn->query($sql);
        $jadwal_latihan = $result->fetch_assoc();
    
        return $jadwal_latihan;
    }

    // Fungsi untuk menambahkan jadwal latihan baru
    public function tambahJadwalLatihan($id_latihan, $hari, $jam) {
        $sql = "INSERT INTO Jadwal_Latihan (id_latihan, hari, jam) VALUES ('$id_latihan', '$hari', '$jam')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Fungsi untuk mengupdate data jadwal latihan
    public function updateJadwalLatihan($id_jadwal, $id_latihan, $hari, $jam) {
        $sql = "UPDATE Jadwal_Latihan SET id_latihan='$id_latihan', hari='$hari',
                jam='$jam' WHERE id_jadwal='$id_jadwal'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Fungsi untuk menghapus jadwal latihan
    public function hapusJadwalLatihan($id_jadwal) {
        $sql = "DELETE FROM Jadwal_Latihan WHERE id_jadwal='$id_jadwal'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    public function confirmDelete()
    {
        return "<script>
        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');
        }
    </script>";
    }
}
