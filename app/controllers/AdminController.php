<?php
// ... (require statements) ...

class AdminController {

    // ... (method index() tetap sama) ...

    public function dashboard() {
        try {
            // Inisialisasi semua model yang diperlukan
            $reservasiModel = new Reservasi();
            $pembayaranModel = new Pembayaran();
            $dokterModel = new Dokter(); // Tambahkan model dokter

            // Mengambil data untuk setiap tab di panel admin
            $data = [
                'antrian' => $reservasiModel->getAntrianHariIni(),
                'riwayat' => $pembayaranModel->getRiwayatTransaksi(),
                // Ambil data untuk form pemeriksaan
                'pasien_antri' => $reservasiModel->getAntrianHariIni(), // Ambil pasien yang antri hari ini
                'dokter_list' => $dokterModel->getAll() // Ambil semua dokter
            ];

            // Memuat view dashboard dan mengirimkan data ke dalamnya
            require_once '../app/views/admin/dashboard.php';
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // ... (method prosesPemeriksaan() dan prosesPembayaran() tetap sama) ...
}



// require_once '../app/models/Reservasi.php';
// require_once '../app/models/Pembayaran.php';
// require_once '../app/models/Dokter.php';
// require_once '../app/models/Pasien.php';
// require_once '../app/models/Layanan.php';

// class AdminController {
    
//     public function index() {
//         // Redirect to dashboard
//         $this->dashboard();
//     }
    
//     public function dashboard() {
//         try {
//             // Inisialisasi semua model yang diperlukan
//             $reservasiModel = new Reservasi();
//             $pembayaranModel = new Pembayaran();
            
//             // Mengambil data untuk setiap tab di panel admin
//             $data = [
//                 'antrian' => $reservasiModel->getAntrianHariIni(),
//                 'riwayat' => $pembayaranModel->getRiwayatTransaksi()
//             ];

//             // Memuat view dashboard dan mengirimkan data ke dalamnya
//             require_once '../app/views/admin/dashboard.php';
//         } catch (Exception $e) {
//             die('Error: ' . $e->getMessage());
//         }
//     }

//     // Metode untuk memproses form pemeriksaan
//     public function prosesPemeriksaan() {
//         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//             try {
//                 // Sanitize input
//                 $pasien = filter_input(INPUT_POST, 'pasien', FILTER_SANITIZE_STRING);
//                 $dokter = filter_input(INPUT_POST, 'dokter', FILTER_SANITIZE_STRING);
//                 $catatan = filter_input(INPUT_POST, 'catatan', FILTER_SANITIZE_STRING);
                
//                 // Validate input
//                 if (empty($pasien) || empty($dokter) || empty($catatan)) {
//                     throw new Exception('Semua field harus diisi.');
//                 }
                
//                 // TODO: Implement pemeriksaan logic
//                 // 1. Parse pasien dan dokter ID dari select option
//                 // 2. Insert ke tabel pemeriksaan
//                 // 3. Update status reservasi
                
//                 // For now, just redirect back with success message
//                 $_SESSION['success'] = 'Pemeriksaan berhasil disimpan!';
//                 header('Location: ' . BASE_URL . '/admin');
//                 exit();
//             } catch (Exception $e) {
//                 $_SESSION['error'] = 'Error: ' . $e->getMessage();
//                 header('Location: ' . BASE_URL . '/admin');
//                 exit();
//             }
//         } else {
//             header('Location: ' . BASE_URL . '/admin');
//             exit();
//         }
//     }

//     public function prosesPembayaran() {
//         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//             try {
//                 // Sanitize input
//                 $pasien = filter_input(INPUT_POST, 'pasien', FILTER_SANITIZE_STRING);
//                 $total = filter_input(INPUT_POST, 'total', FILTER_SANITIZE_STRING);
//                 $metode = filter_input(INPUT_POST, 'metode', FILTER_SANITIZE_STRING);
                
//                 // Validate input
//                 if (empty($pasien) || empty($total) || empty($metode)) {
//                     throw new Exception('Semua field harus diisi.');
//                 }
                
//                 // TODO: Implement pembayaran logic
//                 // 1. Parse data pembayaran
//                 // 2. Insert ke tabel pembayaran
//                 // 3. Update status pemeriksaan
                
//                 // For now, just redirect back with success message
//                 $_SESSION['success'] = 'Pembayaran berhasil diproses!';
//                 header('Location: ' . BASE_URL . '/admin');
//                 exit();
//             } catch (Exception $e) {
//                 $_SESSION['error'] = 'Error: ' . $e->getMessage();
//                 header('Location: ' . BASE_URL . '/admin');
//                 exit();
//             }
//         } else {
//             header('Location: ' . BASE_URL . '/admin');
//             exit();
//         }
//     }
// }