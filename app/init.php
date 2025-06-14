<?php
// init.php

// Memuat file konfigurasi utama
require_once '../config/config.php';

// Memuat semua model yang dibutuhkan
// (Dalam aplikasi nyata yang lebih besar, ini bisa di-autoload secara otomatis)
require_once 'models/Database.php';
require_once 'models/Pasien.php';
require_once 'models/Layanan.php';
require_once 'models/Reservasi.php';
require_once 'models/Pembayaran.php';
require_once 'models/Dokter.php';

// Anda juga bisa menambahkan file-file inti lainnya di sini jika ada.
?>