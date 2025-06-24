<?php

// class Riwayat extends Controller {
//     public function index() {
//         $data['judul'] = 'Halaman Riwayat';

//         // Ambil user id dari session (ganti sesuai sistem login Anda)
//         $pasien_id = 8; // Ganti dengan $_SESSION['user_id'] jika sudah ada sistem login

//         if (!$pasien_id) {
//             echo "Anda belum login.";
//             return;
//         }

//         $data['riwayat'] = $this->model('RiwayatModel')->getRiwayatByPasienId($pasien_id);

//         $this->view('templates/header', $data);
//         $this->view('riwayat/index', $data);
//         $this->view('templates/footer');
//     }
// }


class Riwayat extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'pasien') {
            header('Location: ' . BASEURL . '/login');
            exit;
        }

        $data['judul'] = 'Riwayat Pemeriksaan';
        // Menggunakan fungsi yang sudah dibuat di ReservasiModel
        $data['riwayat'] = $this->model('ReservasiModel')->getRiwayatPasien($_SESSION['pasien_id']); // Menggunakan pasien_id

        $this->view('templates/header', $data);
        $this->view('Riwayat/index', $data);
        $this->view('templates/footer');
    }
}

