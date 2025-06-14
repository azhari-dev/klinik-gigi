<?php
// Pastikan BASE_URL sudah didefinisikan
if (!defined('BASE_URL')) {
    require_once '../config/config.php';
}
?>
<nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center">
                <a href="<?= BASE_URL; ?>" class="text-2xl font-bold text-primary">🦷 Klinik Gigi Sehat - Admin</a>
            </div>
            <div class="flex space-x-4">
                <a href="<?= BASE_URL; ?>" class="text-gray-600 hover:text-primary">Kembali ke Home</a>
                <span class="text-gray-600">|</span>
                <span class="text-gray-800 font-medium">Admin Panel</span>
            </div>
        </div>
    </div>
</nav>