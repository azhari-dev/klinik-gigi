<?php
// require_once 'Database.php';

// class Dokter {
//     private $db;

//     public function __construct() {
//         $this->db = new Database; // Instansiasi koneksi DB
//     }

//     // Mengambil semua data dokter
//     public function getAllDokter() {
//         $this->db->query('SELECT * FROM dokter ORDER BY nama_dokter ASC');
//         return $this->db->resultSet();
//     }

//     // Mengambil data dokter berdasarkan ID
//     public function getById($id) {
//         $this->db->query('SELECT * FROM dokter WHERE dokter_id = :id');
//         $this->db->bind(':id', $id);
//         return $this->db->single();
//     }

//     // Menambahkan dokter baru
//     public function create($data) {
//         $this->db->query('
//             INSERT INTO dokter (nama_dokter, spesialisasi, no_hp, email, jadwal_praktik) 
//             VALUES (:nama_dokter, :spesialisasi, :no_hp, :email, :jadwal_praktik)
//         ');

//         $this->db->bind(':nama_dokter', $data['nama_dokter']);
//         $this->db->bind(':spesialisasi', $data['spesialisasi']);
//         $this->db->bind(':no_hp', $data['no_hp']);
//         $this->db->bind(':email', $data['email']);
//         $this->db->bind(':jadwal_praktik', $data['jadwal_praktik']);

//         return $this->db->execute();
//     }



//     public function getJadwal() {
//         $query = "SELECT d.dokter_id, d.nama_dokter, d.spesialis, j.hari, j.jam_mulai, j.jam_selesai
//                   FROM dokter d
//                   JOIN jadwal_dokter j ON d.dokter_id = j.dokter_id
//                   ORDER BY d.dokter_id, FIELD(j.hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'), j.jam_mulai";
//         $this->db->query($query);
//         return $this->db->resultSet();
//     }   
// }


class Dokter extends Controller
{
    public function __construct()
    {
        // Middleware untuk memastikan hanya dokter yang bisa akses
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'dokter') {
            header('Location: ' . BASEURL . '/login');
            exit;
        }
    }
    
    public function index($tab = 'pemeriksaan') // Default tab pemeriksaan
    {
        $data['judul'] = 'Panel Dokter';
        $data['tab'] = $tab;

        if ($tab === 'antrian') {
            $data['antrian'] = $this->model('ReservasiModel')->getAntrianDokter($_SESSION['user_id']);
        } elseif ($tab === 'pemeriksaan') {
            $data['pasien_sekarang'] = $this->model('ReservasiModel')->getPasienUntukDiperiksa($_SESSION['user_id']);
        } elseif ($tab === 'riwayat') {
            $data['riwayat'] = $this->model('ReservasiModel')->getRiwayatDokter($_SESSION['user_id']);
        }

        $this->view('templates/header_dokter', $data);
        $this->view('Dokter/index', $data); // Menggunakan index.php sebagai template utama
        $this->view('templates/footer');
    }

    public function selesaiPemeriksaan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_reservasi = $_POST['reservasi_id']; // Gunakan 'reservasi_id' sesuai form
            $catatan_dokter = $_POST['catatan_dokter'];

            if ($this->model('ReservasiModel')->selesaikanPemeriksaan($id_reservasi, $catatan_dokter) > 0) {
                // Berhasil
                // Tambahkan flash message jika perlu
            } else {
                // Gagal
                // Tambahkan flash message jika perlu
            }
            // Kembali ke halaman pemeriksaan, otomatis akan load pasien berikutnya
            header('Location: ' . BASEURL . '/dokter/index/pemeriksaan');
            exit;
        }
    }

}