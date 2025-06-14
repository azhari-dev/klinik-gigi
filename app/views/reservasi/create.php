<?php require_once '../app/init.php'; // Muat init.php ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi - Klinik Gigi Sehat</title>
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
    <?php require_once '../app/views/layouts/header.php'; ?>
    
    <div class="max-w-4xl mx-auto p-6 py-16">
        <h2 class="text-3xl font-bold text-center mb-8">Buat Reservasi</h2>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <form id="reservationForm" action="<?= BASE_URL; ?>/reservasi/store" method="POST">
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Data Pasien -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-primary">Data Pasien</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">No. HP</label>
                                <input type="tel" name="no_hp" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                                <textarea name="alamat" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Data Reservasi -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-primary">Data Reservasi</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Layanan</label>
                                <select name="layanan_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                                    <option value="">Pilih Layanan</option>
                                    <?php if (!empty($data['layanan'])): ?>
                                        <?php foreach ($data['layanan'] as $layanan): ?>
                                            <option value="<?= $layanan['layanan_id']; ?>">
                                                <?= htmlspecialchars($layanan['nama_layanan']) . ' - Rp ' . number_format($layanan['harga'], 0, ',', '.'); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Reservasi</label>
                                <input type="date" name="tanggal_reservasi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required min="<?= date('Y-m-d'); ?>">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jam Reservasi</label>
                                <select name="jam_reservasi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                                    <option value="">Pilih Jam</option>
                                    <option value="08:00">08:00</option>
                                    <option value="09:00">09:00</option>
                                    <option value="10:00">10:00</option>
                                    <option value="11:00">11:00</option>
                                    <option value="13:00">13:00</option>
                                    <option value="14:00">14:00</option>
                                    <option value="15:00">15:00</option>
                                    <option value="16:00">16:00</option>
                                </select>
                            </div>
                            
                            <div class="pt-4">
                                <button type="submit" class="w-full bg-primary text-white py-3 rounded-lg font-semibold hover:bg-cyan-700 transition duration-200">
                                    Buat Reservasi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Dengan membuat reservasi, Anda menyetujui syarat dan ketentuan yang berlaku.
                    </p>
                </div>
            </form>
        </div>
    </div>

    <?php require_once '../app/views/layouts/footer.php'; ?>
    
    <script>
        // Set minimum date to today
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.querySelector('input[name="tanggal_reservasi"]');
            const today = new Date().toISOString().split('T')[0];
            dateInput.setAttribute('min', today);
        });
    </script>
</body>
</html>