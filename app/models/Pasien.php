<?php
// require_once 'Database.php';
// =================================================================
// File: app/models/Pasien.php (MODIFIKASI)
// Menambahkan fungsi untuk insert pasien dan mendapatkan ID-nya langsung.
// =================================================================
// class Pasien {
//     private $db;

//     public function __construct() {
//         $this->db = new Database;
//     }

//     // Fungsi baru untuk menangani penambahan pasien dan mengembalikan ID
//     public function tambahPasienDanGetId($data) {
//         // Query untuk memasukkan data pasien baru
//         $query = "INSERT INTO pasien (nama_pasien, no_telp, alamat) VALUES (:nama_pasien, :no_telp, :alamat)";
        
//         $this->db->query($query);
//         $this->db->bind('nama_pasien', $data['nama_pasien']);
//         $this->db->bind('no_telp', $data['no_telp']);
//         $this->db->bind('alamat', $data['alamat']);
        
//         $this->db->execute();
        
//         // Cek jika insert berhasil, lalu kembalikan ID terakhir
//         if ($this->db->rowCount() > 0) {
//             return $this->db->lastInsertId();
//         } else {
//             return false;
//         }
//     }

//     // Fungsi lainnya tetap sama...
//     public function getAllPasien() {
//         $this->db->query('SELECT * FROM pasien');
//         return $this->db->resultSet();
//     }
// }

// require_once 'Database.php';
// =================================================================
// File: app/models/Pasien.php (MODIFIKASI)
// Menambahkan fungsi untuk insert pasien dan mendapatkan ID-nya langsung.
// Menambahkan fungsi untuk mendapatkan pasien berdasarkan user_id.
// =================================================================
class Pasien {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Fungsi baru untuk menangani penambahan pasien dan mengembalikan ID
    public function tambahPasienDanGetId($data) {
        // Query untuk memasukkan data pasien baru
        $query = "INSERT INTO pasien (nama_pasien, no_telp, alamat) VALUES (:nama_pasien, :no_telp, :alamat)";
        
        $this->db->query($query);
        $this->db->bind('nama_pasien', $data['nama_pasien']);
        $this->db->bind('no_telp', $data['no_telp']);
        $this->db->bind('alamat', $data['alamat']);
        
        $this->db->execute();
        
        // Cek jika insert berhasil, lalu kembalikan ID terakhir
        if ($this->db->rowCount() > 0) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    // Fungsi lainnya tetap sama...
    public function getAllPasien() {
        $this->db->query('SELECT * FROM pasien');
        return $this->db->resultSet();
    }

    // Fungsi baru untuk mendapatkan data pasien berdasarkan user_id (pasien_id)
    public function getPasienByUserId($user_id) {
        $this->db->query('SELECT * FROM pasien WHERE pasien_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }
}




