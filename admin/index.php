<?php
session_start();
// Dalam implementasi nyata, tambahkan autentikasi admin
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Klinik Gigi Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0891b2',
                        secondary: '#06b6d4'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <?php include '../includes/admin_navbar.php'; ?>
    
    <div class="max-w-7xl mx-auto p-6">
        <h2 class="text-3xl font-bold text-center mb-8">Panel Admin</h2>
        
        <!-- Admin Navigation -->
        <div class="flex justify-center mb-8">
            <div class="bg-white rounded-lg shadow-md p-2 flex space-x-2">
                <button onclick="showTab('antrian')" class="tab-btn px-4 py-2 rounded bg-primary text-white">Antrian Pasien</button>
                <button onclick="showTab('pemeriksaan')" class="tab-btn px-4 py-2 rounded text-gray-600 hover:bg-gray-100">Pemeriksaan</button>
                <button onclick="showTab('pembayaran')" class="tab-btn px-4 py-2 rounded text-gray-600 hover:bg-gray-100">Pembayaran</button>
                <button onclick="showTab('riwayat')" class="tab-btn px-4 py-2 rounded text-gray-600 hover:bg-gray-100">Riwayat</button>
            </div>
        </div>

        <!-- Tabs Content -->
        <div id="antrian-tab" class="tab-content">
            <?php include 'components/antrian.php'; ?>
        </div>

        <div id="pemeriksaan-tab" class="tab-content hidden">
            <?php include 'components/pemeriksaan.php'; ?>
        </div>

        <div id="pembayaran-tab" class="tab-content hidden">
            <?php include 'components/pembayaran.php'; ?>
        </div>

        <div id="riwayat-tab" class="tab-content hidden">
            <?php include 'components/riwayat.php'; ?>
        </div>
    </div>

    <script src="../assets/js/admin.js"></script>
</body>
</html>