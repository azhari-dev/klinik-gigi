<?php
class Dokter extends Controller
{
    public function index($tab = 'antrian')
    {
        $data['title'] = 'Home dokter';
        $data['tab'] = $tab;

        $this->view('templates/header_dokter', $data);
        $this->view('dokter/index', $data);
        $this->view('templates/footer');
    }
}
?>
