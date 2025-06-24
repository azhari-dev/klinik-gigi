<?php
class Pemeriksaan extends Controller
{
    public function index()
    {
        $this->view('dokter/pemeriksaan', [
            'pasien' => $this->model('PemeriksaanModel')->getPasienDipanggil()
        ]);
    }

    public function selesai()
    {
        $reservasi_id = $_POST['reservasi_id'];
        $catatan = $_POST['catatan'];
        // Ganti dengan session jika sudah ada login dokter
        $dokter_id = 3;

        $this->model('PemeriksaanModel')->selesaikan($reservasi_id, $dokter_id, $catatan);
        header('Location: ' . BASEURL . '/dokter/index/pemeriksaan');
        exit;
    }
}
?>
