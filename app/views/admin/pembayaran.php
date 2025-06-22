<div class="p-6">
    <h3 class="text-xl font-semibold mb-4">Pembayaran</h3>
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <h4 class="font-semibold mb-4">Pasien Menunggu Pembayaran</h4>
            <div class="space-y-3">
                <?php if (!empty($data['tagihan'])): ?>
                    <?php foreach ($data['tagihan'] as $t): ?>
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-semibold"><?= $t['nama_pasien'] ?></p>
                                <p class="text-sm text-gray-600"><?= $t['nama_layanan'] ?></p>
                                
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-primary">Rp <?= number_format($t['harus_dibayar']) ?></p>
                                <button 
                                    onclick="showPaymentModal('<?= $t['nama_pasien'] ?>', '<?= $t['nama_layanan'] ?>', <?= $t['harus_dibayar'] ?>, <?= $t['pemeriksaan_id'] ?>)" 
                                    class="bg-primary text-white px-3 py-1 rounded text-sm mt-1">
                                    Bayar
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-gray-500">Tidak ada tagihan pembayaran.</div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Modal -->
        <div id="paymentModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
                <button onclick="closePaymentModal()" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;</button>
                <h4 class="font-semibold mb-4">Form Pembayaran</h4>
                <form action="<?= BASEURL ?>/admin/prosesPembayaran" method="POST">
                    <input type="hidden" name="pemeriksaan_id" id="modalPemeriksaanId">
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-700">Pasien</label>
                            <input type="text" id="modalPatient" class="w-full px-3 py-2 border bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Layanan</label>
                            <input type="text" id="modalLayanan" class="w-full px-3 py-2 border bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Tagihan</label>
                            <input type="text" id="modalHarga" class="w-full px-3 py-2 border bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Total Bayar</label>
                            <input type="number" name="total_bayar" id="modalTotal" class="w-full px-3 py-2 border" required>
                        </div>
                        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700">
                            Proses Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Modal -->
    </div>
</div>

<script>
function showPaymentModal(pasien, layanan, harga, pemeriksaan_id) {
    document.getElementById('modalPatient').value = pasien;
    document.getElementById('modalLayanan').value = layanan;
    document.getElementById('modalHarga').value = 'Rp ' + harga.toLocaleString('id-ID');
    document.getElementById('modalTotal').value = harga;
    document.getElementById('modalPemeriksaanId').value = pemeriksaan_id;
    document.getElementById('paymentModal').classList.remove('hidden');
}
function closePaymentModal() {
    document.getElementById('paymentModal').classList.add('hidden');
}
</script>


