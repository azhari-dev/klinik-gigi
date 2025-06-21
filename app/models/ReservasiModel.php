<?php

class ReservasiModel
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function tambahReservasi($data)
    {
        $pasien_id = 9; //$_SESSION['user_id'] ?? null;
        if (!$pasien_id) return false;

        $this->db->query("INSERT INTO reservasi (pasien_id, layanan_id, tanggal_reservasi, jam_reservasi, status_id)
                          VALUES (:pasien_id, :layanan_id, :tanggal, :jam, 1)");
        $this->db->bind(':pasien_id', $pasien_id);
        $this->db->bind(':layanan_id', $data['layanan_id']);
        $this->db->bind(':tanggal', $data['tanggal_reservasi']);
        $this->db->bind(':jam', $data['jam_reservasi']);
        return $this->db->execute();
    }

    public function getJamTerpakai($tanggal, $layanan_id)
{
    $this->db->query("SELECT jam_reservasi FROM reservasi WHERE tanggal_reservasi = :tanggal");
    $this->db->bind(':tanggal', $tanggal);
    $result = $this->db->resultSet();
    return array_column($result, 'jam_reservasi');
}

}
?>
