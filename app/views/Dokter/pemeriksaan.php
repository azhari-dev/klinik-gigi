<div class="p-6">
    <h3 class="text-xl font-semibold mb-4">Form Pemeriksaan</h3>
    <form id="examinationForm" action="proses_pemeriksaan.php" method="POST">
        <div class="mt-6 ">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pasien</label>
                <select name="pasien" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                    <option>Budi Santoso - Scaling</option>
                    <option>Siti Aminah - Konsultasi</option>
                </select>
            </div>
            
        </div>
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Dokter</label>
            <textarea name="catatan" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Masukkan catatan pemeriksaan..."></textarea>
        </div>
        <div class="mt-6 text-center">
            <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg font-semibold hover:bg-cyan-700">
                Selesai Pemeriksaan
            </button>
        </div>
    </form>
</div>