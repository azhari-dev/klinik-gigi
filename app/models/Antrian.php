<?php
require_once 'Database.php';

class Antrian {
    private $db;

    public function __construct() {
        $this->db = new Database; // Instansiasi koneksi DB
    }

    
}
