<?php
require_once 'Database.php';

class Dokter {
    private $db;

    public function __construct() {
        $this->db = new Database; // Instansiasi koneksi DB
    }

    /**
     * Mengambil semua data dokter
     * @return array Daftar dokter
     */
    public function getAll() {
        // Kolom 'spesialisasi' diubah menjadi 'spesialis' sesuai database baru
        $this->db->query('SELECT dokter_id, nama_dokter, spesialis FROM dokter ORDER BY nama_dokter ASC');
        return $this->db->resultSet();
    }

    /**
     * Mengambil jadwal praktik dokter
     * @return array Jadwal dokter
     */
    public function getJadwal() {
        // Query ini menggabungkan jadwal dari tabel jadwal_dokter untuk setiap dokter.
        $this->db->query('
            SELECT 
                d.dokter_id,
                d.nama_dokter,
                d.spesialis,
                GROUP_CONCAT(
                    CONCAT(jd.hari, ": ", TIME_FORMAT(jd.jam_mulai, "%H:%i"), " - ", TIME_FORMAT(jd.jam_selesai, "%H:%i")) 
                    ORDER BY FIELD(jd.hari, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu")
                    SEPARATOR ", "
                ) as jadwal_praktik
            FROM dokter d
            LEFT JOIN jadwal_dokter jd ON d.dokter_id = jd.dokter_id
            GROUP BY d.dokter_id, d.nama_dokter, d.spesialis
            ORDER BY d.nama_dokter ASC
        ');
        return $this->db->resultSet();
    }

    /**
     * Mengambil data dokter berdasarkan ID
     * @param int $id ID dokter
     * @return array|false Data dokter atau false jika tidak ditemukan
     */
    public function getById($id) {
        $this->db->query('SELECT * FROM dokter WHERE dokter_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    /**
     * Membuat data dokter baru
     * @param array $data Data dokter
     * @return bool Status berhasil atau tidak
     */
    public function create($data) {
        // Disederhanakan sesuai dengan kolom di database baru
        $this->db->query('
            INSERT INTO dokter (nama_dokter, spesialis) 
            VALUES (:nama_dokter, :spesialis)
        ');

        $this->db->bind(':nama_dokter', $data['nama_dokter']);
        $this->db->bind(':spesialis', $data['spesialis']);

        return $this->db->execute();
    }
}