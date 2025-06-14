<?php
// app/controllers/ReservasiController.php

class ReservasiController {

    // Menampilkan halaman form reservasi
    public function index() {
        $layananModel = new Layanan();
        $data['layanan'] = $layananModel->getAll();

        require_once '../app/views/reservasi/create.php';
    }

    // Menyimpan data reservasi baru
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $dataPasien = [
                'nama_lengkap' => trim($_POST['nama_lengkap']),
                'no_hp' => trim($_POST['no_hp']),
                'tanggal_lahir' => trim($_POST['tanggal_lahir']),
                'alamat' => trim($_POST['alamat'])
            ];
            
            $pasienModel = new Pasien();
            $pasienId = $pasienModel->create($dataPasien);

            if ($pasienId) {
                $dataReservasi = [
                    'pasien_id' => $pasienId,
                    'layanan_id' => trim($_POST['layanan_id']), // ganti ke layanan_id
                    'tanggal_reservasi' => trim($_POST['tanggal_reservasi']),
                    'jam_reservasi' => trim($_POST['jam_reservasi'])
                ];

                $reservasiModel = new Reservasi();
                if ($reservasiModel->create($dataReservasi)) {
                    // Redirect ke halaman utama dengan pesan sukses (opsional)
                    // Anda bisa setup flash message di sini
                    header('Location: ' . BASE_URL . '/home');
                    exit();
                } else {
                    die('Gagal menyimpan data reservasi.');
                }
            } else {
                die('Gagal menyimpan data pasien.');
            }
        } else {
            header('Location: ' . BASE_URL);
            exit();
        }
    }
}
?>