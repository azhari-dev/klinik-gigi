<?php

class JadwalController {
    public function index() {
        // Nanti akan memanggil model untuk mendapatkan data dokter
        // $dokterModel = new Dokter();
        // $jadwalDokter = $dokterModel->getJadwal();

        // Mengirim data ke view
        require_once '../app/views/jadwal/0';
    }
}

?>