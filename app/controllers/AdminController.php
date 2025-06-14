<?php
require_once '../app/models/Reservasi.php';
require_once '../app/models/Pembayaran.php';
// Anda juga perlu me-require model lain yang dibutuhkan seperti Pemeriksaan, Dokter, dll.

class AdminController {
    public function dashboard() {
        // Inisialisasi semua model yang diperlukan
        $reservasiModel = new Reservasi();
        $pembayaranModel = new Pembayaran();
        
        // Mengambil data untuk setiap tab di panel admin
        $data = [
            'antrian' => $reservasiModel->getAntrianHariIni(),
            'riwayat' => $pembayaranModel->getRiwayatTransaksi()
            // 'menunggu_pembayaran' => ... (perlu dibuat method-nya di model)
        ];

        // Memuat view dashboard dan mengirimkan data ke dalamnya
        require_once '../app/views/admin/dashboard.php';
    }

    // Metode lain untuk memproses form
    public function prosesPemeriksaan() {
        // Logika untuk menyimpan data dari form pemeriksaan
        // 1. Validasi input dari $_POST
        // 2. Panggil model Pemeriksaan untuk menyimpan data
        // 3. Redirect kembali ke halaman admin
    }

    public function prosesPembayaran() {
        // Logika untuk menyimpan data dari form pembayaran
    }
}