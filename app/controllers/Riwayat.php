<?php
class Riwayat extends Controller
{
    public function index()
    {
        $data['title'] = 'Riwayat Pembayaran';
        // $data['riwayat'] = $this->model('Pembayaran')->getRiwayat();

        $this->view('templates/header', $data);
        $this->view('riwayat/index', $data);
        $this->view('templates/footer');
    }
}
?>
