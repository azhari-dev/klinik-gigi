<?php

// class Reservasi extends Controller {
//     public function index() {
//         $data['judul'] = 'Halaman Reservasi';
//         $data['layanan'] = $this->model('Layanan')->getAllLayanan();

//         // Ambil user_id dari session (atau sistem login Anda)
//         $user_id = $_SESSION['user_id'] ?? 9; // Ganti dengan sistem login Anda

//         // Ambil reservasi aktif user (status 1/2)
//         $data['reservasi_aktif'] = $this->model('ReservasiModel')->getReservasiAktifByUser($user_id);

//         // Ambil layanan yang dipilih (untuk modal)
//         $layanan_id = $_POST['layanan_id'] ?? $_GET['layanan_id'] ?? null;
//         if ($layanan_id) {
//             $layanan = $this->model('ReservasiModel')->getLayananById($layanan_id);
//             $data['layanan_nama'] = $layanan['nama_layanan'] ?? '';
//         } else {
//             $data['layanan_nama'] = '';
//         }

//         $tanggal = $_GET['tanggal'] ?? date('Y-m-d');

//         $all_jam = [];
//         for ($i = 10; $i <= 21; $i++) {
//             $all_jam[] = sprintf('%02d:00:00', $i);
//         }

//         if ($layanan_id) {
//             $jam_terpakai = $this->model('ReservasiModel')->getJamTerpakai($tanggal, $layanan_id);
//             $data['jam_tersedia'] = array_values(array_diff($all_jam, $jam_terpakai));
//         } else {
//             $data['jam_tersedia'] = $all_jam;
//         }

//         $data['selected_tanggal'] = $tanggal;
//         $data['selected_layanan'] = $layanan_id;

//         $this->view('templates/header', $data);
//         $this->view('reservasi/index', $data);
//         $this->view('templates/footer');
//     }

//     public function tambah()
// {
//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//         if (!isset($_POST['jam_reservasi']) || empty($_POST['jam_reservasi'])) {
//             // Redirect ke halaman form jika jam tidak dipilih
//             header('Location: ' . BASEURL . '/reservasi?layanan_id=' . $_POST['layanan_id'] . '&tanggal=' . $_POST['tanggal_reservasi']);
//             exit;
//         }

//         $data = [
//             'layanan_id' => $_POST['layanan_id'],
//             'tanggal_reservasi' => $_POST['tanggal_reservasi'],
//             'jam_reservasi' => $_POST['jam_reservasi'],
//         ];

//         if ($this->model('ReservasiModel')->tambahReservasi($data)) {
//             header('Location: ' . BASEURL . '/home');
//             exit;
//         } else {
//             header('Location: ' . BASEURL . '/home');
//             exit;
//         }
//     }
// }

// }


class Reservasi extends Controller
{
    public function index()
    {
        // Pastikan pasien sudah login
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'pasien') {
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        $data['judul'] = 'Reservasi';
        $reservasiModel = $this->model('ReservasiModel');
        
        // Cek apakah pasien punya reservasi aktif
        // Gunakan $_SESSION['pasien_id'] yang sudah diset saat login
        $data['has_active_reservation'] = $reservasiModel->checkActiveReservation($_SESSION['pasien_id']); // Menggunakan pasien_id
        
        $data['layanan'] = $this->model('Layanan')->getAllLayanan();
        $data['dokter'] = $this->model('Dokter')->getAllDokter();

        $this->view('templates/header', $data);
        $this->view('reservasi/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'pasien') {
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $reservasiModel = $this->model('ReservasiModel');
            
            // Periksa lagi sebelum menambahkan, untuk keamanan
            // Gunakan $_SESSION['pasien_id']
            if ($reservasiModel->checkActiveReservation($_SESSION['pasien_id'])) { // Menggunakan pasien_id
                echo "Anda sudah memiliki reservasi aktif.";
                header('Location: ' . BASEURL . '/reservasi');
                exit;
            }

            $data = [
                'id_pasien' => $_SESSION['pasien_id'], // Menggunakan pasien_id
                'id_dokter' => $_POST['id_dokter'],
                'id_layanan' => $_POST['id_layanan'],
                'tanggal' => $_POST['tanggal'],
                'jam' => $_POST['jam']
            ];

            if ($this->model('ReservasiModel')->tambahReservasi($data) > 0) {
                header('Location: ' . BASEURL . '/riwayat'); // Arahkan ke riwayat untuk melihat status reservasi
                exit;
            } else {
                header('Location: ' . BASEURL . '/reservasi');
                exit;
            }
        }
    }
}