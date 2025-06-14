<?php
require_once 'Database.php';

class Layanan {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Mengambil semua data layanan dari database
    public function getAll() {
        $this->db->query('SELECT * FROM layanan ORDER BY nama_layanan ASC');
        return $this->db->resultSet();
    }
}
