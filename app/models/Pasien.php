<?php
require_once 'Database.php';

class Pasien {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    /**
     * Membuat data pasien baru di database
     * @param array $data Data pasien dari form
     * @return string ID dari pasien yang baru dibuat
     */
    public function create($data) {
        $this->db->query(
            'INSERT INTO pasien (nama_lengkap, no_hp, tanggal_lahir, alamat) 
             VALUES (:nama_lengkap, :no_hp, :tanggal_lahir, :alamat)'
        );

        // Bind values
        $this->db->bind(':nama_lengkap', $data['nama_lengkap']);
        $this->db->bind(':no_hp', $data['no_hp']);
        $this->db->bind(':tanggal_lahir', $data['tanggal_lahir']);
        $this->db->bind(':alamat', $data['alamat']);

        // Execute
        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
}