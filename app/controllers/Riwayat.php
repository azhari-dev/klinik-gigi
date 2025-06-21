<?php

class Riwayat extends Controller {
    public function index() {
        $data['judul'] = 'Halaman Riwayat';

        // Ambil user id dari session (ganti sesuai sistem login Anda)
        $pasien_id = 8; // Ganti dengan $_SESSION['user_id'] jika sudah ada sistem login

        if (!$pasien_id) {
            echo "Anda belum login.";
            return;
        }

        $data['riwayat'] = $this->model('RiwayatModel')->getRiwayatByPasienId($pasien_id);

        $this->view('templates/header', $data);
        $this->view('riwayat/index', $data);
        $this->view('templates/footer');
    }
}
?>
