<?php
class RiwayatModel {
    private $db;

    public function __construct() {
        $this->db = new Database; // Pastikan class Database sudah ada di project-mu
    }

    public function getRiwayatByPasienId($pasien_id) {
        // Mengambil data dari view v_riwayat_pasien
        $this->db->query("
            SELECT 
                tanggal,
                layanan,
                dokter,
                total,
                total_bayar,
                catatan_dokter
            FROM v_riwayat
            WHERE pasien_id = :pasien_id
            ORDER BY tanggal DESC
        ");
        $this->db->bind(':pasien_id', $pasien_id);
        return $this->db->resultSet();
    }
}
?>
