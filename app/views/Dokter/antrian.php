<div class="p-6">
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
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data['antrian'])): ?>
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 px-4 py-4">Belum ada antrian pasien.</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($data['antrian'] as $antrian): ?>
                        <tr class="border-b">
                            <td class="px-4 py-2"><?= $no++; ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($antrian['nama_pasien']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($antrian['nama_layanan']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars(substr($antrian['jam'], 0, 5)) ?></td>
                            <td class="px-4 py-2"><span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-sm"><?= htmlspecialchars($antrian['status']) ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>