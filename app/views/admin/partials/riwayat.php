<div class="bg-white rounded-lg shadow-md p-6">
    <h3 class="text-xl font-semibold mb-4">Riwayat Transaksi</h3>
    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Nama Pasien</th>
                    <th class="px-4 py-2 text-left">Layanan</th>
                    <th class="px-4 py-2 text-left">Dokter</th>
                    <th class="px-4 py-2 text-left">Total Bayar</th>
                    <th class="px-4 py-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['riwayat'])): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($data['riwayat'] as $item): ?>
                        <tr class="border-b">
                            <td class="px-4 py-2"><?= $no++; ?></td>
                            <td class="px-4 py-2"><?= date('d/m/Y H:i', strtotime($item['waktu_bayar'])); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($item['nama_lengkap']); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($item['nama_layanan']); ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($item['nama_dokter']); ?></td>
                            <td class="px-4 py-2">Rp <?= number_format($item['total_bayar'], 0, ',', '.'); ?></td>
                            <td class="px-4 py-2">
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                                    <?= htmlspecialchars($item['status_bayar']); ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center px-4 py-2 text-gray-500">Belum ada riwayat transaksi.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>