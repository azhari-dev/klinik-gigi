<?php
class Admin extends Controller
{
    public function index($tab = 'antrian')
    {
        $data['title'] = 'Panel Admin';
        $data['tab'] = $tab;

        // Load view utama + partial berdasarkan tab
        $this->view('templates/header_admin', $data);
        $this->view('admin/index', $data); // ini akan memuat tab dinamis
        $this->view('templates/footer');
    }
}
