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
    public function getReservasiAktifByUser($user_id)
{
    $this->db->query("SELECT r.*, l.nama_layanan 
                      FROM reservasi r
                      JOIN layanan l ON r.layanan_id = l.layanan_id
                      WHERE r.pasien_id = :user_id AND r.status_id IN (1,2)
                      ORDER BY r.tanggal_reservasi DESC, r.jam_reservasi DESC
                      LIMIT 1");
    $this->db->bind(':user_id', $user_id);
    return $this->db->single();
}
public function getLayananById($layanan_id)
{
    $this->db->query("SELECT * FROM layanan WHERE layanan_id = :id");
    $this->db->bind(':id', $layanan_id);
    return $this->db->single();
}
}
?>
