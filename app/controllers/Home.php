<?php
class Home extends Controller
{
    public function index()
    {
        $data['title'] = 'Klinik Gigi Sehat';
        $this->view('templates/header', $data);
        $this->view('home/index');
        $this->view('templates/footer');
    }
}
?>
