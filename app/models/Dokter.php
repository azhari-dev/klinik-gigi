<?php
require_once 'Database.php';

class Dokter {
    private $db;

    public function __construct() {
        $this->db = new Database; // Instansiasi koneksi DB
    }

    // Mengambil semua data dokter
    public function getAll() {
        $this->db->query('SELECT * FROM dokter ORDER BY nama_dokter ASC');
        return $this->db->resultSet();
    }

    // Mengambil jadwal praktik dokter
    public function getJadwal() {
        $this->db->query('
            SELECT 
                dokter_id,
                nama_dokter,
                spesialisasi,
                jadwal_praktik,
                no_hp,
                email
            FROM dokter 
            ORDER BY nama_dokter ASC
        ');
        return $this->db->resultSet();
    }

    // Mengambil data dokter berdasarkan ID
    public function getById($id) {
        $this->db->query('SELECT * FROM dokter WHERE dokter_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Menambahkan dokter baru
    public function create($data) {
        $this->db->query('
            INSERT INTO dokter (nama_dokter, spesialisasi, no_hp, email, jadwal_praktik) 
            VALUES (:nama_dokter, :spesialisasi, :no_hp, :email, :jadwal_praktik)
        ');

        $this->db->bind(':nama_dokter', $data['nama_dokter']);
        $this->db->bind(':spesialisasi', $data['spesialisasi']);
        $this->db->bind(':no_hp', $data['no_hp']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':jadwal_praktik', $data['jadwal_praktik']);

        return $this->db->execute();
    }
}
