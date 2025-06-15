
<div class="max-w-6xl mx-auto p-6 py-16">
    <h2 class="text-3xl font-bold text-center mb-8">Jadwal Dokter</h2>
    <div class="grid md:grid-cols-2 gap-6">
        <?php
        // Kelompokkan jadwal berdasarkan dokter
        $dokters = [];
        foreach ($data['jadwal'] as $j) {
            $dokters[$j['dokter_id']]['nama'] = $j['nama_dokter'];
            $dokters[$j['dokter_id']]['spesialis'] = $j['spesialis'];
            $dokters[$j['dokter_id']]['jadwal'][] = [
                'hari' => $j['hari'],
                'jam_mulai' => substr($j['jam_mulai'], 0, 5),
                'jam_selesai' => substr($j['jam_selesai'], 0, 5)
            ];
        }
        foreach ($dokters as $dokter) : ?>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center mb-4">
                <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center text-white text-2xl font-bold">
                    DR
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-semibold"><?= htmlspecialchars($dokter['nama']) ?></h3>
                    <p class="text-gray-600"><?= htmlspecialchars($dokter['spesialis']) ?></p>
                </div>
            </div>
            <div class="space-y-2">
                <?php foreach ($dokter['jadwal'] as $j) : ?>
                <div class="flex justify-between">
                    <span><?= htmlspecialchars($j['hari']) ?></span>
                    <span class="font-semibold"><?= $j['jam_mulai'] ?> - <?= $j['jam_selesai'] ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
