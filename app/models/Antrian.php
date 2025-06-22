<?php
class Antrian
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAntrianHariIni() {
        $this->db->query("CALL ambil_antrian_hari_ini()");
        return $this->db->resultSet();
    }

    public function ubahStatusTerpanggil($id)
    {
        $this->db->query("UPDATE reservasi SET status_id = 2 WHERE reservasi_id = :id AND status_id = 1"); // dari 'menunggu' ke 'diperiksa'
        $this->db->bind(':id', $id);
        $this->db->execute();
    }
}
