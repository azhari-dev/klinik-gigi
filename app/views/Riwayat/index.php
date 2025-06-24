<div class="container mt-5">
    <h3>Riwayat Pemeriksaan Anda</h3>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Layanan</th>
                    <th>Dokter</th>
                    <th>Total Biaya</th>
                    <th>Yang Harus Dibayar</th>
                    <th>Catatan Dokter</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data['riwayat'])) : ?>
                    <tr>
                        <td colspan="6" class="text-center">Anda belum memiliki riwayat pemeriksaan.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($data['riwayat'] as $item) : ?>
                        <tr>
                            <td><?= htmlspecialchars(date('d F Y', strtotime($item['tanggal']))); ?></td>
                            <td><?= htmlspecialchars($item['layanan']); ?></td>
                            <td><?= htmlspecialchars($item['dokter']); ?></td>
                            <td>Rp. <?= number_format($item['total'] ?? 0); ?></td>
                            <td>Rp. <?= number_format($item['total_bayar'] ?? 0); ?></td>
                            <td><?= nl2br(htmlspecialchars($item['catatan_dokter'] ?? 'Tidak ada catatan.')); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
