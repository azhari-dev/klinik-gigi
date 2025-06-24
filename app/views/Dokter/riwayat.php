<div class="container mt-5">
    <h3>Riwayat Pemeriksaan</h3>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Pasien</th>
                    <th>Layanan</th>
                    <th>Catatan Dokter</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data['riwayat'])) : ?>
                    <tr>
                        <td colspan="4" class="text-center">Belum ada riwayat pemeriksaan.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($data['riwayat'] as $item) : ?>
                        <tr>
                            <td><?= htmlspecialchars(date('d F Y', strtotime($item['tanggal']))); ?></td>
                            <td><?= htmlspecialchars($item['nama_pasien']); ?></td>
                            <td><?= htmlspecialchars($item['nama_layanan']); ?></td>
                            <td><?= nl2br(htmlspecialchars($item['catatan_dokter'] ?? '')); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
