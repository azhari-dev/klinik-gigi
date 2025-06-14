<?php
require_once 'Database.php';

class Pembayaran {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // Mengambil riwayat transaksi yang sudah lunas
    public function getRiwayatTransaksi() {
        $this->db->query("
            SELECT 
                pemb.waktu_bayar,
                pas.nama_lengkap,
                lay.nama_layanan,
                dok.nama_dokter,
                pemb.total_bayar,
                pemb.status_bayar
            FROM pembayaran pemb
            JOIN pemeriksaan pem ON pemb.pemeriksaan_id = pem.pemeriksaan_id
            JOIN reservasi r ON pem.reservasi_id = r.reservasi_id
            JOIN pasien pas ON r.pasien_id = pas.pasien_id
            JOIN layanan lay ON r.layanan_id = lay.layanan_id
            JOIN dokter dok ON pem.dokter_id = dok.dokter_id
            WHERE pemb.status_bayar = 'Lunas'
            ORDER BY pemb.waktu_bayar DESC
        ");
        return $this->db->resultSet();
    }

    // Fungsi lainnya
}
