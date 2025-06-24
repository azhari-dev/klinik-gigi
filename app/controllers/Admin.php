<?php
// class Admin extends Controller
// {
//     public function index($tab = 'antrian')
//     {
//         $data['title'] = 'Panel Admin';
//         $data['tab'] = $tab;

//         // Jika tab adalah antrian, ambil datanya
//         if ($tab === 'antrian') {
//             $data['antrian'] = $this->model('Antrian')->getAntrianHariIni();
//         }
//         // Jika tab adalah pembayaran, ambil datanya
//         if ($tab === 'pembayaran') {
//             $data['tagihan'] = $this->model('Pembayaran')->getPasienBelumLunas();
//         }
//         // Jika tab adalah riwayat, ambil datanya
//         if ($tab === 'riwayat') {
//             $data['riwayat'] = $this->model('Pembayaran')->getRiwayatPembayaran();
//         }

//         $this->view('templates/header_admin', $data);
//         $this->view('admin/index', $data);
//         $this->view('templates/footer');
//     }

//     public function panggil($id)
//     {
//         $this->model('Antrian')->ubahStatusTerpanggil($id);
//         header('Location: ' . BASEURL . '/admin?tab=antrian');
//         exit;
//     }

//     public function pembayaran()
//     {
//         $data['title'] = 'Pembayaran';
//         $data['tagihan'] = $this->model('Pembayaran')->getPasienBelumLunas();

//         $this->view('admin/pembayaran', $data);
        
//     }

//     public function prosesPembayaran()
//     {
//         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//             $data = [
//                 'pemeriksaan_id' => $_POST['pemeriksaan_id'],
//                 'total_bayar' => $_POST['total_bayar']
//             ];

//             if ($data['total_bayar'] <= 0) {
//                 echo "Jumlah pembayaran tidak valid.";
//                 exit;
//             }

//             if ($this->model('Pembayaran')->simpanPembayaran($data)) {
//                 header('Location: ' . BASEURL . '/admin/index/pembayaran');
//                 exit;
//             } else {
//                 header('Location: ' . BASEURL . '/admin/index/pembayaran');
//                 exit;
//             }
//         }
//     }

//     public function prosesPelunasan()
//     {
//         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//             $data = [
//                 'pemeriksaan_id' => $_POST['pemeriksaan_id'],
//                 'total_bayar' => $_POST['total_bayar']
//             ];

//             if ($data['total_bayar'] <= 0) {
//                 echo "Jumlah pembayaran tidak valid.";
//                 exit;
//             }

//             if ($this->model('Pembayaran')->simpanPembayaran($data)) {
//                 header('Location: ' . BASEURL . '/admin/index/riwayat');
//                 exit;
//             } else {
//                 header('Location: ' . BASEURL . '/admin/index/riwayat');
//                 exit;
//             }
//         }
//     }

//     public function riwayat()
// {
//     $data['title'] = 'Riwayat Transaksi';
//     $data['riwayat'] = $this->model('Pembayaran')->getRiwayatPembayaran();

//     $this->view('admin/riwayat', $data);
  
// }
//     public function pelunasan($id)
// {
//     if ($this->model('Pembayaran')->prosesPelunasan($id)) {
//         header('Location: ' . BASEURL . '/admin/riwayat/');
//         exit;
//     } else {
//         echo "Gagal melakukan pelunasan.";
//     }
// }



// }


class Admin extends Controller
{
    public function __construct()
    {
        // Middleware untuk memastikan hanya admin yang bisa akses
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: ' . BASEURL . '/login');
            exit;
        }
    }

    public function index($tab = 'antrian')
    {
        $data['judul'] = 'Panel Admin';
        $data['tab'] = $tab; // Untuk menentukan tab mana yang aktif

        // Jika tab adalah antrian, ambil datanya
        if ($tab === 'antrian') {
            $data['antrian'] = $this->model('ReservasiModel')->getAntrianAdmin(); // Gunakan ReservasiModel
        }
        // Jika tab adalah pembayaran, ambil datanya
        if ($tab === 'pembayaran') {
            $data['tagihan'] = $this->model('Pembayaran')->getPasienBelumLunas();
        }
        // Jika tab adalah riwayat, ambil datanya
        if ($tab === 'riwayat') {
            $data['riwayat'] = $this->model('Pembayaran')->getRiwayatPembayaran();
        }

        $this->view('templates/header_admin', $data);
        $this->view('admin/index', $data);
        $this->view('templates/footer');
    }

    public function panggil($id_reservasi)
    {
        // Ubah status ke "Diperiksa" (status_id = 2)
        if ($this->model('ReservasiModel')->updateStatusReservasi($id_reservasi, 2) > 0) {
            // Berhasil
        } else {
            // Gagal
        }
        header('Location: ' . BASEURL . '/admin/index/antrian'); // Redirect ke tab antrian
        exit;
    }

    public function prosesPembayaran()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'pemeriksaan_id' => $_POST['pemeriksaan_id'],
                'total_bayar' => $_POST['total_bayar']
            ];

            if ($data['total_bayar'] <= 0) {
                echo "Jumlah pembayaran tidak valid.";
                exit;
            }

            if ($this->model('Pembayaran')->simpanPembayaran($data)) {
                header('Location: ' . BASEURL . '/admin/index/pembayaran');
                exit;
            } else {
                header('Location: ' . BASEURL . '/admin/index/pembayaran');
                exit;
            }
        }
    }

    public function prosesPelunasan()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pemeriksaan_id = $_POST['pemeriksaan_id'];
            
            if ($this->model('Pembayaran')->prosesPelunasan($pemeriksaan_id)) {
                header('Location: ' . BASEURL . '/admin/index/riwayat');
                exit;
            } else {
                echo "Gagal melakukan pelunasan.";
                header('Location: ' . BASEURL . '/admin/index/riwayat');
                exit;
            }
        }
    }
}