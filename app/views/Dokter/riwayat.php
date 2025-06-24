<div class="p-6">
    <h3 class="text-xl font-semibold mb-4">Riwayat Transaksi</h3>
    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-primary text-white">
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Pasien</th>
                    <th class="px-4 py-2 text-left">Layanan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['riwayat_dokter'])): ?>
                    <?php foreach ($data['riwayat_dokter'] as $row): ?>
                        <tr class="border-b">
                            <td class="px-4 py-2"><?= htmlspecialchars($row['tanggal']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($row['nama_pasien']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($row['layanan']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 px-4 py-4">Belum ada transaksi pembayaran.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>



