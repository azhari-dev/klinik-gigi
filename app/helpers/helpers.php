<?php

// Mengambil base URL dari konfigurasi
function base_url($path = '')
{
    return rtrim(BASEURL, '/') . '/' . ltrim($path, '/');
}

// Fungsi untuk redirect
function redirect($url)
{
    header("Location: " . base_url($url));
    exit;
}

// Menampilkan data aman dari XSS
function e($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Format tanggal Indonesia (dd/mm/yyyy)
function format_tanggal($tanggal)
{
    return date('d/m/Y', strtotime($tanggal));
}

// Format waktu (jam:menit)
function format_jam($waktu)
{
    return date('H:i', strtotime($waktu));
}

// Format angka ke format rupiah
function rupiah($angka)
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}
