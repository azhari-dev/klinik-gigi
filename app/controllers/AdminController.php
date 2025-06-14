<?php
require_once '../app/models/Reservasi.php';
require_once '../app/models/Pembayaran.php';
require_once '../app/models/Dokter.php';
require_once '../app/models/Pasien.php';
require_once '../app/models/Layanan.php';

class AdminController {
    
    public function index() {
        // Redirect to dashboard
        $this->dashboard();
    }
    
    public function dashboard() {
        try {
            // Inisialisasi semua model yang diperlukan
            $reservasiModel = new Reservasi();
            $pembayaranModel = new Pembayaran();
            
            // Mengambil data untuk setiap tab di panel admin
            $data = [
                'antrian' => $reservasiModel->getAntrianHariIni(),
                'riwayat' => $pembayaranModel->getRiwayatTransaksi()
                // 'menunggu_pembayaran' => ... (akan ditambahkan nanti)
            ];

            // Memuat view dashboard dan mengirimkan data ke dalamnya
            require_once '../app/views/admin/dashboard.php';
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Metode untuk memproses form pemeriksaan
    public function prosesPemeriksaan() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                // Sanitize input
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                // Validate input
                if (empty($_POST['pasien']) || empty($_POST['dokter']) || empty($_POST['catatan'])) {
                    throw new Exception('Semua field harus diisi.');
                }
                
                // TODO: Implement pemeriksaan logic
                // 1. Parse pasien dan dokter ID dari select option
                // 2. Insert ke tabel pemeriksaan
                // 3. Update status reservasi
                
                // For now, just redirect back
                header('Location: ' . BASE_URL . '/admin?success=pemeriksaan');
                exit();
            } catch (Exception $e) {
                die('Error: ' . $e->getMessage());
            }
        } else {
            header('Location: ' . BASE_URL . '/admin');
            exit();
        }
    }

    public function prosesPembayaran() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                // Sanitize input
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                // Validate input
                if (empty($_POST['pasien']) || empty($_POST['total']) || empty($_POST['metode'])) {
                    throw new Exception('Semua field harus diisi.');
                }
                
                // TODO: Implement pembayaran logic
                // 1. Parse data pembayaran
                // 2. Insert ke tabel pembayaran
                // 3. Update status pemeriksaan
                
                // For now, just redirect back
                header('Location: ' . BASE_URL . '/admin?success=pembayaran');
                exit();
            } catch (Exception $e) {
                die('Error: ' . $e->getMessage());
            }
        } else {
            header('Location: ' . BASE_URL . '/admin');
            exit();
        }
    }
}