<div class="container mt-5">
    <h3>Form Pemeriksaan Pasien</h3>
    <hr>

    <?php if ($data['pasien_sekarang']) : ?>
        <form action="<?= BASEURL; ?>/dokter/selesaiPemeriksaan" method="post">
            <input type="hidden" name="reservasi_id" value="<?= $data['pasien_sekarang']['id']; ?>">

            <div class="form-group">
                <label for="nama_pasien">Nama Pasien</label>
                <input type="text" class="form-control" id="nama_pasien" value="<?= htmlspecialchars($data['pasien_sekarang']['nama_pasien']); ?>" readonly>
                <small class="form-text text-muted">Nama pasien diisi otomatis dari antrian.</small>
            </div>

            <div class="form-group">
                <label for="catatan_dokter">Catatan Dokter</label>
                <textarea class="form-control" id="catatan_dokter" name="catatan_dokter" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Selesai Pemeriksaan</button>
        </form>
    <?php else : ?>
        <div class="alert alert-info" role="alert">
            Belum ada pasien yang mengantri untuk diperiksa.
        </div>
    <?php endif; ?>
</div>