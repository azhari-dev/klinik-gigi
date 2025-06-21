<?php

class Reservasi extends Controller {
    public function index() {
        $data['judul'] = 'Halaman Reservasi';
        $data['dokter'] = $this->model('Dokter')->getAllDokter();
        $data['layanan'] = $this->model('Layanan')->getAllLayanan();

        $tanggal = $_GET['tanggal'] ?? date('Y-m-d');
        $layanan_id = $_GET['layanan_id'] ?? null;

        $all_jam = [];
        for ($i = 10; $i <= 21; $i++) {
            $all_jam[] = sprintf('%02d:00:00', $i);
        }

        if ($layanan_id) {
            $jam_terpakai = $this->model('ReservasiModel')->getJamTerpakai($tanggal, $layanan_id);
            $data['jam_tersedia'] = array_values(array_diff($all_jam, $jam_terpakai));
        } else {
            $data['jam_tersedia'] = $all_jam;
        }

        $data['selected_tanggal'] = $tanggal;
        $data['selected_layanan'] = $layanan_id;

        $this->view('templates/header', $data);
        $this->view('reservasi/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['jam_reservasi']) || empty($_POST['jam_reservasi'])) {
            // Redirect ke halaman form jika jam tidak dipilih
            header('Location: ' . BASEURL . '/reservasi?layanan_id=' . $_POST['layanan_id'] . '&tanggal=' . $_POST['tanggal_reservasi']);
            exit;
        }

        $data = [
            'layanan_id' => $_POST['layanan_id'],
            'tanggal_reservasi' => $_POST['tanggal_reservasi'],
            'jam_reservasi' => $_POST['jam_reservasi'],
        ];

        if ($this->model('ReservasiModel')->tambahReservasi($data)) {
            header('Location: ' . BASEURL . '/home');
            exit;
        } else {
            header('Location: ' . BASEURL . '/home');
            exit;
        }
    }
}

}
