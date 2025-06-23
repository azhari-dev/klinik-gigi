<div class="max-w-4xl mx-auto p-6 py-16">
    <h2 class="text-3xl font-bold text-center mb-8">Buat Reservasi</h2>
    <div class="bg-white rounded-lg shadow-md p-6">
        <?php if (!empty($data['reservasi_aktif']) && in_array($data['reservasi_aktif']['status_id'], [1,2])): ?>
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 p-4 rounded mb-6">
                <strong>Anda sudah memiliki reservasi yaitu:</strong><br>
                Layanan: <?= htmlspecialchars($data['reservasi_aktif']['nama_layanan']) ?><br>
                Tanggal: <?= htmlspecialchars($data['reservasi_aktif']['tanggal_reservasi']) ?><br>
                Jam: <?= htmlspecialchars($data['reservasi_aktif']['jam_reservasi']) ?><br><br>
                <strong>Jangan lupa datang tepat waktu ya :) </strong><br>
            </div>
        <?php else: ?>
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
                            <?php
                            // Cek tanggal yang dipilih
                            $selected = $data['selected_tanggal'] ?? '';
                            $today = date('Y-m-d');
                            if ($selected && $selected <= $today):
                            ?>
                                <tr>
                                    <td colspan="2" class="py-4 text-red-500 font-semibold">Pilih tanggal setelah hari ini</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($data['jam_tersedia'] as $jam): ?>
                                    <tr>
                                        <td class="border px-4 py-2"><?= $jam ?></td>
                                        <td class="border px-4 py-2">
                                            <button type="button"
                                                class="bg-primary text-white px-4 py-2 rounded hover:bg-cyan-700"
                                                onclick="bukaModalKonfirmasi('<?= htmlspecialchars($jam) ?>')">
                                                Pilih
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if (empty($data['jam_tersedia'])): ?>
                                    <tr><td colspan="2" class="py-4 text-gray-500">Tidak ada jam tersedia</td></tr>
                                <?php endif; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </form>
            
        <?php endif; ?>
    </div>
</div>

<!-- Modal Konfirmasi Reservasi -->
<div id="modalKonfirmasi" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
        <button onclick="tutupModalKonfirmasi()" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;</button>
        <h3 class="text-xl font-semibold mb-4">Konfirmasi Reservasi</h3>
        <form id="modalForm" action="<?= BASEURL ?>/reservasi/tambah" method="POST">
            <input type="hidden" name="layanan_id" value="<?= $data['selected_layanan'] ?>">
            <input type="hidden" name="tanggal_reservasi" value="<?= $data['selected_tanggal'] ?>">
            <input type="hidden" name="jam_reservasi" id="modalJamInput">
            
            <div class="mb-3">
                <label class="font-medium">Layanan</label>
                <?php if ($data['selected_layanan'] == "1"): ?>
                    <div class="border px-3 py-2 rounded bg-gray-50">Pemeriksaan Umum</div>
                <?php elseif ($data['selected_layanan'] == "2"): ?>
                    <div class="border px-3 py-2 rounded bg-gray-50">Tambal Gigi</div>
                <?php elseif ($data['selected_layanan'] == "3"): ?>
                    <div class="border px-3 py-2 rounded bg-gray-50">Cabut Gigi</div>
                <?php elseif ($data['selected_layanan'] == "4"): ?>
                    <div class="border px-3 py-2 rounded bg-gray-50">Scaling</div>
                <?php else: ?>
                    <div class="border px-3 py-2 rounded bg-gray-50">-</div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label class="font-medium">Tanggal</label>
                <div class="border px-3 py-2 rounded bg-gray-50"><?= htmlspecialchars($data['selected_tanggal']) ?></div>
            </div>
            <div class="mb-3">
                <label class="font-medium">Jam</label>
                <div class="border px-3 py-2 rounded bg-gray-50" id="modalJamShow"></div>
            </div>
            <div class="flex gap-2 mt-6">
                <button type="button" onclick="tutupModalKonfirmasi()" class="w-1/2 bg-gray-300 text-gray-700 py-2 rounded-lg font-semibold hover:bg-gray-400">Batal</button>
                <button type="submit" class="w-1/2 bg-primary text-white py-2 rounded-lg font-semibold hover:bg-cyan-700">Kirim</button>
            </div>
        </form>
    </div>
</div>

<script>
function bukaModalKonfirmasi(jam) {
    document.getElementById('modalJamShow').textContent = jam;
    document.getElementById('modalJamInput').value = jam;
    document.getElementById('modalKonfirmasi').classList.remove('hidden');
}
function tutupModalKonfirmasi() {
    document.getElementById('modalKonfirmasi').classList.add('hidden');
}
</script>
