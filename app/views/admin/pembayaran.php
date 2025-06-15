<div class="p-6">
    <h3 class="text-xl font-semibold mb-4">Pembayaran</h3>
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <h4 class="font-semibold mb-4">Pasien Menunggu Pembayaran</h4>
            <div class="space-y-3">
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-semibold">Budi Santoso</p>
                            <p class="text-sm text-gray-600">Scaling</p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-primary">Rp 150.000</p>
                            <button 
                                onclick="showPaymentModal('Budi Santoso', 'Scaling', 150000)" 
                                class="bg-primary text-white px-3 py-1 rounded text-sm mt-1">
                                Bayar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div id="paymentModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
                <button onclick="closePaymentModal()" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;</button>
                <h4 class="font-semibold mb-4">Form Pembayaran</h4>
                <form action="proses_pembayaran.php" method="POST">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pasien</label>
                            <input type="text" id="modalPatient" name="pasien" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Layanan</label>
                            <input type="text" id="modalLayanan" name="layanan" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Harga yang Harus Dibayar</label>
                            <input type="text" id="modalHarga" name="harga" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Total Bayar</label>
                            <input type="number" id="modalTotal" name="total" class="w-full px-3 py-2 border border-gray-300 rounded-md" min="0" required>
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
function showPaymentModal(pasien, layanan, harga) {
    document.getElementById('modalPatient').value = pasien;
    document.getElementById('modalLayanan').value = layanan;
    document.getElementById('modalHarga').value = 'Rp ' + harga.toLocaleString('id-ID');
    document.getElementById('modalTotal').value = harga;
    document.getElementById('paymentModal').classList.remove('hidden');
}
function closePaymentModal() {
    document.getElementById('paymentModal').classList.add('hidden');
}
</script>