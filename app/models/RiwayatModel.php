<?php
class RiwayatModel {
    private $db;

    public function __construct() {
        $this->db = new Database; // Pastikan class Database sudah ada di project-mu
    }

    public function getRiwayatByPasienId($pasien_id) {
        // Mengambil data dari view v_riwayat
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

    public function getRiwayatByDokterId($dokter_id) {
        $this->db->query("
            SELECT 
                v.tanggal,
                v.layanan,
                v.dokter,
                v.total,
                v.total_bayar,
                v.catatan_dokter,
                v.pasien_id,
                p.nama_pasien
            FROM v_riwayat v
            JOIN dokter d ON v.dokter = d.nama_dokter
            JOIN reservasi r ON v.tanggal = r.tanggal_reservasi AND v.layanan = (SELECT nama_layanan FROM layanan WHERE layanan_id = r.layanan_id)
            JOIN pasien p ON v.pasien_id = p.pasien_id
            WHERE d.dokter_id = :dokter_id
            ORDER BY v.tanggal DESC
        ");
        $this->db->bind(':dokter_id', $dokter_id);
        return $this->db->resultSet();
    }
}
?>
