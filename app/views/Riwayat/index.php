<div class="p-6 py-16 ">
    <h2 class="text-2xl font-bold mb-6 mt-6 text-primary">Riwayat</h2>
    <div class="overflow-x-auto rounded-lg shadow">
        <table class="w-full table-auto bg-white rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-primary text-white">
                    <th class="px-6 py-3 text-left font-semibold">Tanggal</th>
                    <th class="px-6 py-3 text-left font-semibold">Layanan</th>
                    <th class="px-6 py-3 text-left font-semibold">Dokter</th>
                    <th class="px-6 py-3 text-left font-semibold">Total</th>
                    <th class="px-6 py-3 text-left font-semibold">Yang harus dibayar</th>
                    <th class="px-6 py-3 text-left font-semibold">Catatan Dokter</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data['riwayat'])): ?>
                    <tr>
                        <td colspan="6" class="py-4 text-center">Tidak ada riwayat.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($data['riwayat'] as $row): ?>
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-6 py-4"><?= htmlspecialchars($row['tanggal']) ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($row['layanan']) ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($row['dokter']) ?></td>
                            <td class="px-6 py-4 text-green-600 font-semibold">Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                            <td class="px-6 py-4 text-red-600 font-semibold">Rp <?= number_format($row['total_bayar'], 0, ',', '.') ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($row['catatan_dokter']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
