<div class="bg-white rounded-lg shadow-md p-6">
    <h3 class="text-xl font-semibold mb-4">Form Pemeriksaan</h3>
    
    <!-- Alert Messages -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
    
    <form id="examinationForm" action="<?= BASE_URL; ?>/admin/prosesPemeriksaan" method="POST">
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pasien</label>
                <select name="pasien" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                    <option value="">Pilih Pasien</option>
                    <option value="1">Budi Santoso - Scaling</option>
                    <option value="2">Siti Aminah - Konsultasi</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Dokter</label>
                <select name="dokter" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                    <option value="">Pilih Dokter</option>
                    <option value="1">Dr. Sarah Wijaya</option>
                    <option value="2">Dr. Ahmad Fauzi</option>
                </select>
            </div>
        </div>
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Dokter</label>
            <textarea name="catatan" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Masukkan catatan pemeriksaan..." required></textarea>
        </div>
        <div class="mt-6 text-center">
            <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-semibold hover:bg-cyan-700">
                Selesai Pemeriksaan
            </button>
        </div>
    </form>
</div>