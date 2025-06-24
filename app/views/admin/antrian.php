<div class="container mt-5">
    <h3>Antrian Pasien Hari Ini (<?= date('d F Y'); ?>)</h3>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Layanan</th>
                <th>Jam</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data['antrian'])) : ?>
                <tr>
                    <td colspan="6" class="text-center">Belum ada antrian untuk hari ini.</td>
                </tr>
            <?php else : ?>
                <?php $no = 1; foreach ($data['antrian'] as $antrian) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($antrian['nama_pasien']); ?></td>
                        <td><?= htmlspecialchars($antrian['layanan']); ?></td>
                        <td><?= htmlspecialchars(substr($antrian['jam_reservasi'], 0, 5)); ?></td> <td>
                            <?php if ($antrian['status_id'] == 1): ?>
                                <span class="badge badge-info">Menunggu</span> <?php elseif ($antrian['status_id'] == 2): ?>
                                <span class="badge badge-warning">Diperiksa</span> <?php elseif ($antrian['status_id'] == 3): ?>
                                <span class="badge badge-success">Selesai</span> <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($antrian['status_id'] == 1): ?>
                                <a href="<?= BASEURL; ?>/admin/panggil/<?= $antrian['reservasi_id']; ?>" class="btn btn-success btn-sm">Panggil</a>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-sm" disabled>Sudah Dipanggil</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>