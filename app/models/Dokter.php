<?php
// require_once 'Database.php';

class Dokter {
    private $db;

    public function __construct() {
        $this->db = new Database; // Instansiasi koneksi DB
    }

    public function getJadwal() {
        $query = "SELECT d.dokter_id, d.nama_dokter, d.spesialis, j.hari, j.jam_mulai, j.jam_selesai
                  FROM dokter d
                  JOIN jadwal_dokter j ON d.dokter_id = j.dokter_id
                  ORDER BY d.dokter_id, FIELD(j.hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'), j.jam_mulai";
        $this->db->query($query);
        return $this->db->resultSet();
    }
}
