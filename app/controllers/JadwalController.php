<?php
require_once '../app/models/Dokter.php'; // Pastikan model di-load

class JadwalController {
    public function index() {
        // Instansiasi model untuk mendapatkan data dokter
        $dokterModel = new Dokter();
        $data['jadwalDokter'] = $dokterModel->getJadwal(); // Ambil data jadwal

        // Mengirim data ke view
        require_once '../app/views/jadwal/index.php'; // Perbaiki path view
    }
}

?>