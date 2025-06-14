<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Dokter - Klinik Gigi Sehat</title>
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
    
    <div class="max-w-6xl mx-auto p-6 py-16">
        <h2 class="text-3xl font-bold text-center mb-8">Jadwal Dokter</h2>

        <div class="grid md:grid-cols-2 gap-6">
            <?php if (!empty($data['jadwalDokter'])): ?>
                <?php foreach ($data['jadwalDokter'] as $dokter): ?>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center text-white text-2xl font-bold">
                            DR
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-semibold"><?= htmlspecialchars($dokter['nama_dokter']); ?></h3>
                            <p class="text-gray-600"><?= htmlspecialchars($dokter['spesisalis']); ?></p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <?php 
                        // Memecah jadwal praktik menjadi baris-baris
                        $jadwal_list = explode(',', $dokter['jadwal_praktik']);
                        foreach($jadwal_list as $jadwal_item) {
                            $parts = explode(':', $jadwal_item, 2);
                            $hari = trim($parts[0]);
                            $jam = isset($parts[1]) ? trim($parts[1]) : '';
                        ?>
                        <div class="flex justify-between">
                            <span><?= htmlspecialchars($hari); ?></span>
                            <span class="font-semibold"><?= htmlspecialchars($jam); ?></span>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center md:col-span-2">Jadwal dokter tidak tersedia saat ini.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php require_once '../app/views/layouts/footer.php'; ?>
</body>
</html>