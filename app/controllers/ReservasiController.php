<?php
// app/controllers/ReservasiController.php

// Require model dependencies
require_once '../app/models/Layanan.php';
require_once '../app/models/Pasien.php';
require_once '../app/models/Reservasi.php';

class ReservasiController {

    // Menampilkan halaman form reservasi
    // Diakses via GET /reservasi
    public function index() {
        try {
            $layananModel = new Layanan();
            // Mengirim data layanan ke view untuk ditampilkan di dropdown
            $data['layanan'] = $layananModel->getAll();

            require_once '../app/views/reservasi/create.php';
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Menyimpan data reservasi baru
    // Diakses via POST /reservasi/store
    public function store() {
        // Kode store() sudah benar dan tidak perlu diubah.
        // ... (isi method store() tetap sama) ...
    }
}



// // app/controllers/ReservasiController.php

// // Require model dependencies
// require_once '../app/models/Layanan.php';
// require_once '../app/models/Pasien.php';
// require_once '../app/models/Reservasi.php';

// class ReservasiController {

//     // Menampilkan halaman form reservasi
//     public function index() {
//         try {
//             $layananModel = new Layanan();
//             $data['layanan'] = $layananModel->getAll();

//             require_once '../app/views/reservasi/create.php';
//         } catch (Exception $e) {
//             die('Error: ' . $e->getMessage());
//         }
//     }

//     // Menyimpan data reservasi baru
//     public function store() {
//         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//             try {
//                 // Sanitize input data
//                 $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

//                 // Validate required fields
//                 $requiredFields = ['nama_lengkap', 'no_hp', 'tanggal_lahir', 'alamat', 'layanan_id', 'tanggal_reservasi', 'jam_reservasi'];
//                 foreach ($requiredFields as $field) {
//                     if (empty(trim($_POST[$field]))) {
//                         die('Error: Field ' . $field . ' wajib diisi.');
//                     }
//                 }

//                 // Prepare patient data
//                 $dataPasien = [
//                     'nama_lengkap' => trim($_POST['nama_lengkap']),
//                     'no_hp' => trim($_POST['no_hp']),
//                     'tanggal_lahir' => trim($_POST['tanggal_lahir']),
//                     'alamat' => trim($_POST['alamat'])
//                 ];
                
//                 // Create patient record
//                 $pasienModel = new Pasien();
//                 $pasienId = $pasienModel->create($dataPasien);

//                 if ($pasienId) {
//                     // Prepare reservation data
//                     $dataReservasi = [
//                         'pasien_id' => $pasienId,
//                         'layanan_id' => trim($_POST['layanan_id']),
//                         'tanggal_reservasi' => trim($_POST['tanggal_reservasi']),
//                         'jam_reservasi' => trim($_POST['jam_reservasi'])
//                     ];

//                     // Create reservation record
//                     $reservasiModel = new Reservasi();
//                     if ($reservasiModel->create($dataReservasi)) {
//                         // Redirect with success message
//                         header('Location: ' . BASE_URL . '/home?success=reservasi');
//                         exit();
//                     } else {
//                         throw new Exception('Gagal menyimpan data reservasi.');
//                     }
//                 } else {
//                     throw new Exception('Gagal menyimpan data pasien.');
//                 }
//             } catch (Exception $e) {
//                 die('Error: ' . $e->getMessage());
//             }
//         } else {
//             // If not POST request, redirect to home
//             header('Location: ' . BASE_URL);
//             exit();
//         }
//     }
// }
?>