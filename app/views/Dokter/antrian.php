<div class="p-6">
    <h3 class="text-2xl font-bold mb-6 text-primary">Antrian Hari Ini</h3>
    <div class="overflow-x-auto rounded-lg shadow">
        <table class="w-full table-auto bg-white rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-primary text-white">
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">Nama Pasien</th>
                    <th class="px-4 py-2 text-left">Layanan</th>
                    <th class="px-4 py-2 text-left">Jam</th>
                    <th class="px-4 py-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['antrian'])): ?>
                    <?php $no = 1; foreach ($data['antrian'] as $row): ?>
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-4 py-2"><?= $no++ ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($row['nama_pasien']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($row['layanan']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($row['jam_reservasi']) ?></td>
                            <td class="px-4 py-2">
                                <?php
                                    $status = [
                                        1 => 'Menunggu',
                                        2 => 'Diperiksa',
                                        3 => 'Selesai'
                                    ];
                                    echo $status[$row['status_id']] ?? 'Tidak diketahui';
                                ?>
                            </td>
                            
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center px-4 py-4">Tidak ada antrian hari ini.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
