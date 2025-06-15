<?php
require_once 'Database.php';

// class Reservasi {
//     private $db;

//     public function __construct() {
//         $this->db = new Database;
//     }

//     // Menambahkan data reservasi baru
//     public function create($data) {
//         $this->db->query(
//             'INSERT INTO reservasi (pasien_id, layanan_id, tanggal_reservasi, jam_reservasi, status) 
//              VALUES (:pasien_id, :layanan_id, :tanggal_reservasi, :jam_reservasi, :status)'
//         );

//         $this->db->bind(':pasien_id', $data['pasien_id']);
//         $this->db->bind(':layanan_id', $data['layanan_id']);
//         $this->db->bind(':tanggal_reservasi', $data['tanggal_reservasi']);
//         $this->db->bind(':jam_reservasi', $data['jam_reservasi']);
//         $this->db->bind(':status', 'Menunggu'); // status default

//         return $this->db->execute();
//     }

//     // Mengambil data antrian untuk hari ini
//     public function getAntrianHariIni() {
//         $this->db->query("
//             SELECT 
//                 p.nama_lengkap, 
//                 l.nama_layanan, 
//                 r.jam_reservasi, 
//                 r.status 
//             FROM reservasi r
//             JOIN pasien p ON r.pasien_id = p.pasien_id
//             JOIN layanan l ON r.layanan_id = l.layanan_id
//             WHERE r.tanggal_reservasi = CURDATE()
//             ORDER BY r.jam_reservasi ASC
//         ");
//         return $this->db->resultSet();
//     }
// }

// =================================================================
// File: app/models/Reservasi.php (PERBAIKAN TOTAL)
// Memperbaiki query JOIN dan logika penambahan data.
// =================================================================
class Reservasi_model { // Nama class disesuaikan dengan standar (jika file namanya Reservasi.php, classnya Reservasi_model atau Reservasi)
    private $table = 'reservasi';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Query diperbaiki dengan JOIN untuk mendapatkan data yang lengkap
    public function getAllReservasi() {
        $query = "SELECT 
                    reservasi.*, 
                    pasien.nama_pasien, 
                    pasien.no_telp,
                    dokter.nama_dokter, 
                    layanan.nama_layanan
                  FROM " . $this->table . "
                  JOIN pasien ON reservasi.id_pasien = pasien.id_pasien
                  JOIN dokter ON reservasi.id_dokter = dokter.id_dokter
                  JOIN layanan ON reservasi.id_layanan = layanan.id_layanan
                  ORDER BY reservasi.tanggal_reservasi ASC, reservasi.jam_reservasi ASC";
        
        $this->db->query($query);
        return $this->db->resultSet();
    }

    // Logika penambahan data diubah total untuk menerima ID yang sudah ada
    public function tambahReservasi($data) {
        $query = "INSERT INTO " . $this->table . " (id_pasien, id_dokter, id_layanan, tanggal_reservasi, jam_reservasi, status)
                  VALUES (:id_pasien, :id_dokter, :id_layanan, :tanggal_reservasi, :jam_reservasi, :status)";

        $this->db->query($query);
        $this->db->bind('id_pasien', $data['id_pasien']); // Menerima id_pasien dari controller
        $this->db->bind('id_dokter', $data['id_dokter']);
        $this->db->bind('id_layanan', $data['id_layanan']);
        $this->db->bind('tanggal_reservasi', $data['tanggal_reservasi']);
        $this->db->bind('jam_reservasi', $data['jam_reservasi']);
        $this->db->bind('status', 'Menunggu'); // Status default

        $this->db->execute();
        return $this->db->rowCount();
    }
}



?>
