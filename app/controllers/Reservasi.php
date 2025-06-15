<?php

// class Reservasi extends Controller
// {
//     public function index()
//     {
//         $data['title'] = 'Reservasi Klinik Gigi Sehat';
//         $this->view('templates/header', $data);
//         $this->view('reservasi/index');
//         $this->view('templates/footer');
//     }

//     public function create()
// {
//     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//         // ambil data dari form POST
//         $nama = $_POST['nama'];
//         $layanan = $_POST['layanan'];
//         // dll...

//         // validasi dan simpan ke model
//         $this->model('Reservasi')->tambahReservasi([
//             'nama' => $nama,
//             'layanan' => $layanan
//         ]);

//         header('Location: /klinik-gigi/reservasi/sukses');
//         exit;
//     } else {
//         // tampilkan form jika bukan POST
//         $this->view('templates/header');
//         $this->view('reservasi/create');
//         $this->view('templates/footer');
//     }
// }

// }

// =================================================================
// File: app/controllers/Reservasi.php (PERBAIKAN TOTAL)
// Mengubah alur kerja penambahan reservasi.
// =================================================================
class Reservasi extends Controller {
    public function index() {
        // Mengambil data dokter dan layanan untuk ditampilkan di form
        $data['judul'] = 'Halaman Reservasi';
        $data['dokter'] = $this->model('Dokter')->getAllDokter();
        $data['layanan'] = $this->model('Layanan')->getAllLayanan();
        
        $this->view('templates/header', $data);
        $this->view('reservasi/index', $data);
        $this->view('templates/footer');
    }

    public function tambah() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // 1. Siapkan data pasien dari form
            $data_pasien = [
                'nama_pasien' => $_POST['nama_pasien'],
                'no_telp'     => $_POST['no_telp'],
                'alamat'      => $_POST['alamat']
            ];

            // 2. Tambahkan pasien baru dan dapatkan ID-nya
            $pasienModel = $this->model('Pasien');
            $id_pasien_baru = $pasienModel->tambahPasienDanGetId($data_pasien);

            if ($id_pasien_baru) {
                // 3. Jika pasien berhasil dibuat, siapkan data reservasi
                $data_reservasi = [
                    'id_pasien'         => $id_pasien_baru,
                    'id_dokter'         => $_POST['id_dokter'],
                    'id_layanan'        => $_POST['id_layanan'],
                    'tanggal_reservasi' => $_POST['tanggal_reservasi'],
                    'jam_reservasi'     => $_POST['jam_reservasi']
                ];
                
                // 4. Panggil model reservasi untuk menyimpan data
                if ($this->model('Reservasi_model')->tambahReservasi($data_reservasi) > 0) {
                    // Redirect atau tampilkan pesan sukses
                    header('Location: ' . BASEURL . '/home'); // Arahkan ke home setelah sukses
                    exit;
                } else {
                    // Tampilkan pesan error jika gagal membuat reservasi
                    die('Gagal membuat reservasi.');
                }

            } else {
                // Tampilkan pesan error jika gagal membuat data pasien
                die('Gagal menyimpan data pasien.');
            }
        }
    }
}
?>
