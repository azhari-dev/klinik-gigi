<?php
class Dokter extends Controller
{
    public function index($tab = 'antrian')
    {
        $data['title'] = 'Home dokter';
        $data['tab'] = $tab;

        // Contoh: dokter_id bisa diambil dari session login
        $dokter_id = 3;

        if ($tab === 'antrian') {
            $data['antrian'] = $this->model('Antrian')->getAntrianHariIni();
        }

        if ($tab === 'pemeriksaan') {
            $data['pasien'] = $this->model('PemeriksaanModel')->getPasienDipanggil();
        
        }

        if ($tab === 'riwayat') {
            $data['riwayat_dokter'] = $this->model('RiwayatModel')->getRiwayatByDokterId($dokter_id);
        }

        $this->view('templates/header_dokter', $data);
        $this->view('dokter/index', $data);
        $this->view('templates/footer');
    }

    public function selesaiPemeriksaan()
    {
        $reservasi_id = $_POST['reservasi_id'];
        $catatan = $_POST['catatan'];
        $dokter_id = 3;

        $this->model('PemeriksaanModel')->selesaikan($reservasi_id, $dokter_id, $catatan);

        // Kembali ke tab pemeriksaan
        header('Location: ' . BASEURL . '/dokter/index/pemeriksaan');
        exit;
    }
}
?>
