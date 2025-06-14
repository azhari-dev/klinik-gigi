<?php
require_once 'Database.php';

class Reservasi {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Menambahkan data reservasi baru
    public function create($data) {
        $this->db->query(
            'INSERT INTO reservasi (pasien_id, layanan_id, tanggal_reservasi, jam_reservasi, status) 
             VALUES (:pasien_id, :layanan_id, :tanggal_reservasi, :jam_reservasi, :status)'
        );

        $this->db->bind(':pasien_id', $data['pasien_id']);
        $this->db->bind(':layanan_id', $data['layanan_id']);
        $this->db->bind(':tanggal_reservasi', $data['tanggal_reservasi']);
        $this->db->bind(':jam_reservasi', $data['jam_reservasi']);
        $this->db->bind(':status', 'Menunggu'); // status default

        return $this->db->execute();
    }

    // Mengambil data antrian untuk hari ini
    public function getAntrianHariIni() {
        $this->db->query("
            SELECT 
                p.nama_lengkap, 
                l.nama_layanan, 
                r.jam_reservasi, 
                r.status 
            FROM reservasi r
            JOIN pasien p ON r.pasien_id = p.pasien_id
            JOIN layanan l ON r.layanan_id = l.layanan_id
            WHERE r.tanggal_reservasi = CURDATE()
            ORDER BY r.jam_reservasi ASC
        ");
        return $this->db->resultSet();
    }
}
?>
