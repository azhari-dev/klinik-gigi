<?php $pasien = $pasien ?? (isset($data['pasien']) ? $data['pasien'] : null); ?>
<div class="p-6">
    <h3 class="text-xl font-semibold mb-4">Form Pemeriksaan</h3>
    <?php if (!empty($pasien) && is_array($pasien)): ?>
    <form id="examinationForm" action="<?= BASEURL ?>/pemeriksaan/selesai" method="POST">
        <input type="hidden" name="reservasi_id" value="<?= htmlspecialchars($pasien['reservasi_id']) ?>">
        <div class="mt-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pasien</label>
                <input type="text" name="pasien" id="pasien"
                    value="<?= htmlspecialchars($pasien['nama_pasien']) ?>"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                    readonly>
            </div>
        </div>
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Dokter</label>
            <textarea name="catatan" rows="4"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
                placeholder="Masukkan catatan pemeriksaan..." required></textarea>
        </div>
        <div class="mt-6 text-center">
            <button type="submit"
                class="bg-primary text-white px-6 py-2 rounded-lg font-semibold hover:bg-cyan-700">
                Selesai Pemeriksaan
            </button>
        </div>
    </form>
    <?php else: ?>
    <div class="mt-6 text-center text-gray-500">
        Tidak ada pasien dipanggil.
    </div>
    <?php endif; ?>
</div>
