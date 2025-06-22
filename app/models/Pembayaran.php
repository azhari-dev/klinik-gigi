<?php
class Pembayaran
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Ambil semua pasien yang belum lunas
    public function getPasienBelumLunas()
    {
        $this->db->query("SELECT *
                          FROM pembayaran b
                          JOIN pemeriksaan pm ON b.pemeriksaan_id = pm.pemeriksaan_id
                          JOIN reservasi r ON pm.reservasi_id = r.reservasi_id
                          JOIN pasien p ON r.pasien_id = p.pasien_id
                          JOIN layanan l ON r.layanan_id = l.layanan_id
                          WHERE b.status_id = 1 AND b.total_bayar = 0");
        return $this->db->resultSet();
    }

    // Simpan pembayaran baru (update total_bayar)
    public function simpanPembayaran($data)
    {
        $pemeriksaan_id = $data['pemeriksaan_id'] ?? null;
        if (!$pemeriksaan_id) return false;

        // Tambahkan pembayaran
        $this->db->query("UPDATE pembayaran 
                          SET total_bayar = total_bayar + :bayar 
                          WHERE pemeriksaan_id = :pemeriksaan_id");
        $this->db->bind(':bayar', $data['total_bayar']);
        $this->db->bind(':pemeriksaan_id', $pemeriksaan_id);
        $this->db->execute();

        // Ambil total_bayar dan harus_dibayar terbaru
        $this->db->query("SELECT total_bayar, harus_dibayar FROM pembayaran WHERE pemeriksaan_id = :pemeriksaan_id");
        $this->db->bind(':pemeriksaan_id', $pemeriksaan_id);
        $row = $this->db->single();

        // Jika sudah lunas, update status_id menjadi 2
        if ($row && $row['total_bayar'] >= $row['harus_dibayar']) {
            $this->db->query("UPDATE pembayaran SET status_id = 2 WHERE pemeriksaan_id = :pemeriksaan_id");
            $this->db->bind(':pemeriksaan_id', $pemeriksaan_id);
            $this->db->execute();
        }

        return true;
    }

    public function getRiwayatPembayaran()
{
    $this->db->query("SELECT 
                        pm.pemeriksaan_id,
                        pm.tanggal_pemeriksaan,
                        p.nama_pasien,
                        l.nama_layanan,
                        d.nama_dokter,
                        b.total_bayar,
                        b.harus_dibayar,
                        b.status_id
                      FROM pembayaran b
                      JOIN pemeriksaan pm ON b.pemeriksaan_id = pm.pemeriksaan_id
                      JOIN reservasi r ON pm.reservasi_id = r.reservasi_id
                      JOIN pasien p ON r.pasien_id = p.pasien_id
                      JOIN layanan l ON r.layanan_id = l.layanan_id
                      JOIN dokter d ON pm.dokter_id = d.dokter_id
                      ORDER BY pm.tanggal_pemeriksaan DESC");
    return $this->db->resultSet();
}

    public function prosesPelunasan($pemeriksaan_id)
    {
        $this->db->query("SELECT harus_dibayar FROM pembayaran WHERE pemeriksaan_id = :id");
        $this->db->bind(':id', $pemeriksaan_id);
        $row = $this->db->single();
        $total = $row['harus_dibayar'] ?? 0;

        $this->db->query("UPDATE pembayaran SET total_bayar = :total, status_id = 2 WHERE pemeriksaan_id = :id");
        $this->db->bind(':total', $total);
        $this->db->bind(':id', $pemeriksaan_id);
        return $this->db->execute();
    }


}
