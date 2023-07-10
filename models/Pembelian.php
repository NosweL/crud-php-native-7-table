<?php
class Pembelian {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Fungsi untuk mengambil semua pembelian
    public function getAllPembelian() {
        $sql = "SELECT * FROM Pembelian p JOIN anggota ag ON p.id_anggota = ag.id_anggota JOIN suplemen sp ON p.id_suplemen = sp.id_suplemen";
        $result = $this->conn->query($sql);
        $pembelian = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $pembelian[] = $row;
            }
        }

        return $pembelian;
    }

    public function getPembelianById($id) {
        $sql = "SELECT * FROM Pembelian WHERE id_pembelian = '$id'";
        $result = $this->conn->query($sql);

        if ($result->num_rows === 1) {
            return $result->fetch_assoc();
        }

        return null;
    }

    // Fungsi untuk menambahkan pembelian baru
    public function tambahPembelian($id_anggota, $id_suplemen, $tanggal_pembelian, $jumlah) {
        $sql = "INSERT INTO Pembelian (id_anggota, id_suplemen, tanggal_pembelian, jumlah)
                VALUES ('$id_anggota', '$id_suplemen', '$tanggal_pembelian', '$jumlah')";

        return $this->conn->query($sql);
    }

    // Fungsi untuk mengupdate data pembelian
    public function updatePembelian($id_pembelian, $id_anggota, $id_suplemen, $tanggal_pembelian, $jumlah) {
        $sql = "UPDATE Pembelian SET id_anggota='$id_anggota', id_suplemen='$id_suplemen',
                tanggal_pembelian='$tanggal_pembelian', jumlah='$jumlah' WHERE id_pembelian='$id_pembelian'";

        return $this->conn->query($sql);
    }

    // Fungsi untuk menghapus pembelian
    public function hapusPembelian($id_pembelian) {
        $sql = "DELETE FROM Pembelian WHERE id_pembelian='$id_pembelian'";

        return $this->conn->query($sql);
    }
    public function confirmDelete()
    {
        return "<script>
        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus pembelian ini?');
        }
    </script>";
    }
}
