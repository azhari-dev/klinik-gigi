<div class="bg-white rounded-lg shadow-md p-6">
    <h3 class="text-xl font-semibold mb-4">Antrian Pasien Hari Ini</h3>
    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">Nama Pasien</th>
                    <th class="px-4 py-2 text-left">Layanan</th>
                    <th class="px-4 py-2 text-left">Jam</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['antrian'])): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($data['antrian'] as $item): ?>
                        <tr class="border-b">
                            <td class="px-4 py-2"><?= $no++; ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($item['nama_lengkap']); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($item['nama_layanan']); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($item['jam_reservasi']); ?></td>
                            <td class="px-4 py-2">
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-sm">
                                    <?= htmlspecialchars($item['status']); ?>
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                <button onclick="callPatient('<?= htmlspecialchars($item['nama_lengkap']); ?>')" class="bg-primary text-white px-3 py-1 rounded text-sm hover:bg-cyan-700">Panggil</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center px-4 py-2">Tidak ada antrian hari ini.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>