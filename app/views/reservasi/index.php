<div class="max-w-4xl mx-auto p-6 py-16">
    <h2 class="text-3xl font-bold text-center mb-8">Buat Reservasi</h2>
    <div class="bg-white rounded-lg shadow-md p-6">
        <form id="reservationForm" action="<?= BASEURL ?>/reservasi/tambah" method="POST">
            <label class="block text-sm font-medium text-gray-700 mb-2">Layanan</label>
            <div class="grid mb-4 gap-6">
                <select name="layanan_id" onchange="this.form.submit()" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2" required>
                    <option value="">Pilih Layanan</option>
                    <?php foreach ($data['layanan'] as $layanan): ?>
                        <option value="<?= $layanan['layanan_id'] ?>" <?= $data['selected_layanan'] == $layanan['layanan_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($layanan['nama_layanan']) ?> - Rp <?= number_format($layanan['harga'], 0, ',', '.') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Reservasi</label>
            <div class="grid mb-4 gap-6">
                <input type="date" name="tanggal_reservasi" value="<?= $data['selected_tanggal'] ?>" onchange="this.form.submit()" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2" required>
            </div>

            <?php if ($data['selected_layanan']): ?>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Jam Tersedia</label>
                <div class="overflow-x-auto mb-4">
                    <table class="min-w-full border text-center">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Jam</th>
                                <th class="border px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['jam_tersedia'] as $jam): ?>
                                <tr>
                                    <td class="border px-4 py-2"><?= $jam ?></td>
                                    <td class="border px-4 py-2">
                                        <button type="submit" name="jam_reservasi" value="<?= $jam ?>" class="bg-primary text-white px-4 py-2 rounded hover:bg-cyan-700">
                                            Pilih
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($data['jam_tersedia'])): ?>
                                <tr><td colspan="2" class="py-4 text-gray-500">Tidak ada jam tersedia</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>
