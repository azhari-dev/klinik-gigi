<?php

class Reservasi extends Controller
{
    public function index()
    {
        $data['title'] = 'Reservasi Klinik Gigi Sehat';
        $this->view('templates/header', $data);
        $this->view('reservasi/index');
        $this->view('templates/footer');
    }

    public function create()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // ambil data dari form POST
        $nama = $_POST['nama'];
        $layanan = $_POST['layanan'];
        // dll...

        // validasi dan simpan ke model
        $this->model('Reservasi')->tambahReservasi([
            'nama' => $nama,
            'layanan' => $layanan
        ]);

        header('Location: /klinik-gigi/reservasi/sukses');
        exit;
    } else {
        // tampilkan form jika bukan POST
        $this->view('templates/header');
        $this->view('reservasi/create');
        $this->view('templates/footer');
    }
}

}
?>
