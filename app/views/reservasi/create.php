<?php require_once '../app/init.php'; // Muat init.php ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi - Klinik Gigi Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    </head>
<body class="bg-gray-50">
    <?php require_once '../app/views/layouts/header.php'; ?>
    
    <div class="max-w-4xl mx-auto p-6 py-16">
        <h2 class="text-3xl font-bold text-center mb-8">Buat Reservasi</h2>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <form id="reservationForm" action="<?= BASE_URL; ?>/reservasi/store" method="POST">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Layanan</label>
                        <select name="layanan_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                            <option value="">Pilih Layanan</option>
                            <?php if (!empty($data['layanan'])): ?>
                                <?php foreach ($data['layanan'] as $layanan): ?>
                                    <option value="<?= $layanan['layanan_id']; ?>">
                                        <?= htmlspecialchars($layanan['nama_layanan']) . ' - Rp ' . number_format($layanan['harga']); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    
                    </div>
                </form>
        </div>
    </div>

    <?php require_once '../app/views/layouts/footer.php'; ?>
</body>
</html>