<?php
class PemeriksaanModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getPasienDipanggil()
    {
        $this->db->query("SELECT * FROM v_pasien_dipanggil");
        return $this->db->single();
    }

    public function selesaikan($reservasi_id, $dokter_id, $catatan)
    {
        $this->db->query("CALL selesaikan_pemeriksaan(:reservasi_id, :dokter_id, :catatan)");
        $this->db->bind('reservasi_id', $reservasi_id);
        $this->db->bind('dokter_id', $dokter_id);
        $this->db->bind('catatan', $catatan);
        $this->db->execute();
    }

}
