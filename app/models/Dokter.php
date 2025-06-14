<?php

class Dokter {
    private $db;

    public function __construct() {
        $this->db = new Database; // Instansiasi koneksi DB
    }

    public function getJadwal() {
        // Kode query untuk SELECT jadwal dari database
        // return $hasil_query;
    }
}

?>