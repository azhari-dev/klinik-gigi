<?php

// class ReservasiModel
// {
//     private $db;
//     public function __construct()
//     {
//         $this->db = new Database;
//     }

//     public function tambahReservasi($data)
//     {
//         $pasien_id = 9; //$_SESSION['user_id'] ?? null;
//         if (!$pasien_id) return false;

//         $this->db->query("INSERT INTO reservasi (pasien_id, layanan_id, tanggal_reservasi, jam_reservasi, status_id)
//                           VALUES (:pasien_id, :layanan_id, :tanggal, :jam, 1)");
//         $this->db->bind(':pasien_id', $pasien_id);
//         $this->db->bind(':layanan_id', $data['layanan_id']);
//         $this->db->bind(':tanggal', $data['tanggal_reservasi']);
//         $this->db->bind(':jam', $data['jam_reservasi']);
//         return $this->db->execute();
//     }

//     public function getJamTerpakai($tanggal, $layanan_id)
// {
//     $this->db->query("SELECT jam_reservasi FROM reservasi WHERE tanggal_reservasi = :tanggal");
//     $this->db->bind(':tanggal', $tanggal);
//     $result = $this->db->resultSet();
//     return array_column($result, 'jam_reservasi');
// }
//     public function getReservasiAktifByUser($user_id)
// {
//     $this->db->query("SELECT r.*, l.nama_layanan 
//                       FROM reservasi r
//                       JOIN layanan l ON r.layanan_id = l.layanan_id
//                       WHERE r.pasien_id = :user_id AND r.status_id IN (1,2)
//                       ORDER BY r.tanggal_reservasi DESC, r.jam_reservasi DESC
//                       LIMIT 1");
//     $this->db->bind(':user_id', $user_id);
//     return $this->db->single();
// }
// public function getLayananById($layanan_id)
// {
//     $this->db->query("SELECT * FROM layanan WHERE layanan_id = :id");
//     $this->db->bind(':id', $layanan_id);
//     return $this->db->single();
// }
// }

class ReservasiModel
{
    private $table = 'reservasi';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllReservasi()
    {
        // Perbaiki JOINs agar sesuai dengan skema database
        $this->db->query('SELECT r.*, p.nama_pasien, d.nama_dokter, l.nama_layanan, sr.nama_status as status_nama 
                          FROM ' . $this->table . ' r
                          JOIN pasien p ON p.pasien_id = r.pasien_id 
                          JOIN dokter d ON d.dokter_id = r.dokter_id 
                          JOIN layanan l ON l.layanan_id = r.layanan_id
                          JOIN status_reservasi sr ON sr.status_id = r.status_id');
        return $this->db->resultSet();
    }

    // Fungsi untuk membuat reservasi baru dengan status 'menunggu' (status_id = 1)
    public function tambahReservasi($data)
    {
        $query = "INSERT INTO reservasi (pasien_id, dokter_id, layanan_id, tanggal_reservasi, jam_reservasi, status_id) 
                  VALUES (:pasien_id, :dokter_id, :layanan_id, :tanggal_reservasi, :jam_reservasi, 1)"; // status_id 1 = Menunggu
        $this->db->query($query);
        $this->db->bind('pasien_id', $data['id_pasien']);
        $this->db->bind('dokter_id', $data['id_dokter']);
        $this->db->bind('layanan_id', $data['id_layanan']);
        $this->db->bind('tanggal_reservasi', $data['tanggal']);
        $this->db->bind('jam_reservasi', $data['jam']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    // Fungsi untuk memeriksa apakah pasien memiliki reservasi aktif (status_id 1: Menunggu, 2: Diperiksa)
    public function checkActiveReservation($pasien_id)
    {
        $this->db->query("SELECT reservasi_id FROM " . $this->table . " WHERE pasien_id = :pasien_id AND status_id IN (1, 2)"); // status_id 1 = Menunggu, 2 = Diperiksa
        $this->db->bind('pasien_id', $pasien_id);
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }

    // Fungsi untuk mendapatkan antrian untuk admin (status 'menunggu' pada hari ini)
    public function getAntrianAdmin()
    {
        $today = date('Y-m-d');
        // Menggunakan prosedur tersimpan `ambil_antrian_hari_ini`
        $this->db->query("CALL ambil_antrian_hari_ini()");
        return $this->db->resultSet();
    }

    // Fungsi untuk mendapatkan antrian untuk dokter (status 'diperiksa' pada hari ini)
    public function getAntrianDokter($dokter_id)
    {
        $today = date('Y-m-d');
        $this->db->query("SELECT r.reservasi_id AS id, p.nama_pasien, l.nama_layanan, r.jam_reservasi AS jam, sr.nama_status AS status
                          FROM " . $this->table . " r
                          JOIN pasien p ON r.pasien_id = p.pasien_id 
                          JOIN layanan l ON r.layanan_id = l.layanan_id 
                          JOIN status_reservasi sr ON r.status_id = sr.status_id
                          WHERE r.dokter_id = :dokter_id 
                          AND r.tanggal = :tanggal 
                          AND r.status_id = 2 
                          ORDER BY r.jam_reservasi ASC"); // status_id 2 = Diperiksa
        $this->db->bind('dokter_id', $dokter_id);
        $this->db->bind('tanggal', $today);
        return $this->db->resultSet();
    }

    // Fungsi untuk mengambil pasien berikutnya untuk diperiksa oleh dokter
    public function getPasienUntukDiperiksa($dokter_id)
    {
        $today = date('Y-m-d');
        $this->db->query("SELECT r.reservasi_id AS id, p.nama_pasien, l.nama_layanan 
                          FROM " . $this->table . " r
                          JOIN pasien p ON r.pasien_id = p.pasien_id 
                          JOIN layanan l ON r.layanan_id = l.layanan_id 
                          WHERE r.dokter_id = :dokter_id 
                          AND r.tanggal = :tanggal 
                          AND r.status_id = 2 
                          ORDER BY r.jam_reservasi ASC LIMIT 1"); // status_id 2 = Diperiksa
        $this->db->bind('dokter_id', $dokter_id);
        $this->db->bind('tanggal', $today);
        return $this->db->single();
    }

    // Fungsi untuk mengubah status reservasi
    public function updateStatusReservasi($id_reservasi, $status_id) // Ubah ke status_id
    {
        $query = "UPDATE " . $this->table . " SET status_id = :status_id WHERE reservasi_id = :id_reservasi";
        $this->db->query($query);
        $this->db->bind('status_id', $status_id); // Gunakan status_id
        $this->db->bind('id_reservasi', $id_reservasi);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // Fungsi untuk menyelesaikan pemeriksaan (update status dan tambah catatan dokter)
    public function selesaikanPemeriksaan($id_reservasi, $catatan_dokter)
    {
        // Pertama, update status reservasi menjadi "Selesai" (status_id = 3)
        $query = "UPDATE " . $this->table . " SET status_id = 3 WHERE reservasi_id = :id_reservasi";
        $this->db->query($query);
        $this->db->bind('id_reservasi', $id_reservasi);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            // Dapatkan informasi reservasi untuk pemeriksaan
            $this->db->query('SELECT pasien_id, layanan_id, dokter_id, tanggal FROM ' . $this->table . ' WHERE reservasi_id = :id_reservasi');
            $this->db->bind('id_reservasi', $id_reservasi);
            $reservasi = $this->db->single();

            // Masukkan data ke tabel pemeriksaan
            $this->db->query('INSERT INTO pemeriksaan (reservasi_id, dokter_id, tanggal_pemeriksaan, catatan_dokter) VALUES (:reservasi_id, :dokter_id, :tanggal_pemeriksaan, :catatan_dokter)');
            $this->db->bind('reservasi_id', $id_reservasi);
            $this->db->bind('dokter_id', $reservasi['dokter_id']);
            $this->db->bind('tanggal_pemeriksaan', $reservasi['tanggal_reservasi']);
            $this->db->bind('catatan_dokter', $catatan_dokter);
            $this->db->execute();
            $pemeriksaan_id = $this->db->lastInsertId(); // Ambil ID pemeriksaan yang baru saja di-insert

            // Ambil harga layanan untuk membuat pembayaran
            $this->db->query('SELECT harga FROM layanan WHERE layanan_id = :layanan_id');
            $this->db->bind('layanan_id', $reservasi['layanan_id']);
            $layanan = $this->db->single();

            // Buat entri di tabel pembayaran (status_id = 1: Belum Lunas)
            $query_pembayaran = "INSERT INTO pembayaran (pemeriksaan_id, total_bayar, harus_dibayar, status_id) VALUES (:pemeriksaan_id, 0.00, :harus_dibayar, 1)";
            $this->db->query($query_pembayaran);
            $this->db->bind('pemeriksaan_id', $pemeriksaan_id);
            $this->db->bind('harus_dibayar', $layanan['harga']);
            $this->db->execute();
        }

        return $this->db->rowCount();
    }

    // Fungsi untuk mendapatkan riwayat pemeriksaan pasien
    public function getRiwayatPasien($pasien_id)
    {
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

    // Fungsi untuk mendapatkan riwayat pemeriksaan dari sisi dokter
    public function getRiwayatDokter($dokter_id)
    {
        $this->db->query("
            SELECT 
                pm.tanggal_pemeriksaan AS tanggal, 
                p.nama_pasien, 
                l.nama_layanan, 
                pm.catatan_dokter
            FROM pemeriksaan pm
            JOIN reservasi r ON pm.reservasi_id = r.reservasi_id
            JOIN pasien p ON r.pasien_id = p.pasien_id
            JOIN layanan l ON r.layanan_id = l.layanan_id
            WHERE pm.dokter_id = :dokter_id 
            ORDER BY pm.tanggal_pemeriksaan DESC
        ");
        $this->db->bind('dokter_id', $dokter_id);
        return $this->db->resultSet();
    }
}
