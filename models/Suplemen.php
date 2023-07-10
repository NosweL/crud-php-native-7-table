<?php
class Suplemen
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Fungsi untuk mengambil semua suplemen
    public function getAllSuplemen()
    {
        $query = "SELECT * FROM suplemen";
        $result = $this->conn->query($query);
        $suplemenList = array();

        while ($row = $result->fetch_assoc()) {
            $suplemenList[] = $row;
        }

        return $suplemenList;
    }

    public function getSuplemenById($id)
    {
        $sql = "SELECT * FROM Suplemen WHERE id_suplemen = '$id'";
        $result = $this->conn->query($sql);

        if ($result->num_rows === 1) {
            return $result->fetch_assoc(); // Return a single row
        } else {
            return null;
        }
    }

    // Fungsi untuk menambahkan suplemen baru
    public function tambahSuplemen($nama, $harga, $stok)
    {
        $sql = "INSERT INTO Suplemen (nama, harga, stok) VALUES ('$nama', '$harga', '$stok')";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Fungsi untuk mengupdate data suplemen
    public function updateSuplemen($id_suplemen, $nama, $harga, $stok)
    {
        $sql = "UPDATE Suplemen SET nama='$nama', harga='$harga', stok='$stok' WHERE id_suplemen='$id_suplemen'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    
    public function updateStokSuplemen($id_suplemen, $stok)
    {
        $query = "UPDATE suplemen SET stok = ? WHERE id_suplemen = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $stok, $id_suplemen);
        return $stmt->execute();
    }

    // Fungsi untuk menghapus suplemen
    public function hapusSuplemen($id_suplemen)
    {
        $isUsed = $this->isSuplemenUsed($id_suplemen);

        if ($isUsed) {
            return 'Suplemen sedang digunakan.';
        }

        $sql = "DELETE FROM Suplemen WHERE id_suplemen='$id_suplemen'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    // Fungsi untuk memeriksa apakah suplemen digunakan
    public function isSuplemenUsed($id_suplemen)
    {
        $sql = "SELECT * FROM Suplemen WHERE id_suplemen='$id_suplemen'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function formatRupiah($harga)
    {
        return 'Rp ' . number_format($harga, 0, ',', '.');
    }

    public function confirmDelete()
    {
        return "<script>
        function confirmDelete() {
            return confirm('Apakah Anda yakin ingin menghapus suplemen ini?');
        }
        </script>";
    }
}
