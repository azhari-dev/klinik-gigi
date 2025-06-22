<?php
class Admin extends Controller
{
    public function index($tab = 'antrian')
    {
        $data['title'] = 'Panel Admin';
        $data['tab'] = $tab;

        // Jika tab adalah antrian, ambil datanya
        if ($tab === 'antrian') {
            $data['antrian'] = $this->model('Antrian')->getAntrianHariIni();
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

    public function panggil($id)
    {
        $this->model('Antrian')->ubahStatusTerpanggil($id);
        header('Location: ' . BASEURL . '/admin?tab=antrian');
        exit;
    }

    public function pembayaran()
    {
        $data['title'] = 'Pembayaran';
        $data['tagihan'] = $this->model('Pembayaran')->getPasienBelumLunas();

        $this->view('admin/pembayaran', $data);
        
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
            $data = [
                'pemeriksaan_id' => $_POST['pemeriksaan_id'],
                'total_bayar' => $_POST['total_bayar']
            ];

            if ($data['total_bayar'] <= 0) {
                echo "Jumlah pembayaran tidak valid.";
                exit;
            }

            if ($this->model('Pembayaran')->simpanPembayaran($data)) {
                header('Location: ' . BASEURL . '/admin/index/riwayat');
                exit;
            } else {
                header('Location: ' . BASEURL . '/admin/index/riwayat');
                exit;
            }
        }
    }

    public function riwayat()
{
    $data['title'] = 'Riwayat Transaksi';
    $data['riwayat'] = $this->model('Pembayaran')->getRiwayatPembayaran();

    $this->view('admin/riwayat', $data);
  
}
    public function pelunasan($id)
{
    if ($this->model('Pembayaran')->prosesPelunasan($id)) {
        header('Location: ' . BASEURL . '/admin/riwayat/');
        exit;
    } else {
        echo "Gagal melakukan pelunasan.";
    }
}



}
