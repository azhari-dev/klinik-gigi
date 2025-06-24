<?php
// class Dokter extends Controller
// {
//     public function index($tab = 'antrian')
//     {
//         $data['title'] = 'Home dokter';
//         $data['tab'] = $tab;

//         $this->view('templates/header_dokter', $data);
//         $this->view('dokter/index', $data);
//         $this->view('templates/footer');
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