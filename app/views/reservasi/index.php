<div class="container mt-5">
    <h2>Buat Reservasi</h2>
    <hr>

    <?php if ($data['has_active_reservation']) : ?>
        <div class="alert alert-warning" role="alert">
            Anda sudah memiliki reservasi yang aktif. Anda baru bisa membuat reservasi lagi setelah pemeriksaan selesai. Silakan cek halaman <a href="<?= BASEURL; ?>/riwayat">Riwayat</a> untuk melihat status reservasi Anda.
        </div>
    <?php else : ?>
        <form action="<?= BASEURL; ?>/reservasi/tambah" method="post">
            <div class="form-group">
                <label for="layanan">Pilih Layanan</label>
                <select class="form-control" id="layanan_id" name="layanan_id" required>
                    <?php foreach ($data['layanan'] as $layanan) : ?>
                        <option value="<?= $layanan['layanan_id']; ?>"><?= $layanan['nama_layanan']; ?> (Rp. <?= number_format($layanan['harga']); ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="dokter">Pilih Dokter</label>
                <select class="form-control" id="id_dokter" name="id_dokter" required>
                    <?php foreach ($data['dokter'] as $dokter) : ?>
                        <option value="<?= $dokter['dokter_id']; ?>"><?= $dokter['nama_dokter']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal">Pilih Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <div class="form-group">
                <label for="jam">Pilih Jam</label>
                <input type="time" class="form-control" id="jam" name="jam" required>
            </div>
            <button type="submit" class="btn btn-primary">Buat Reservasi</button>
        </form>
    <?php endif; ?>

</div>