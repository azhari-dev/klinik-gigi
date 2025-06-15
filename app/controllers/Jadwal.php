<?php
class Jadwal extends Controller
{
    public function index()
    {
        $data['title'] = 'Jadwal Dokter';
        $data['jadwal'] = $this->model('Dokter')->getJadwal(); 

        $this->view('templates/header', $data);
        $this->view('jadwal/index', $data);
        $this->view('templates/footer');
    }
}
?>
