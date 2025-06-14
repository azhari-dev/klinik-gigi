<div class="bg-white rounded-lg shadow-md p-6">
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
                            <button onclick="showPaymentForm('Budi Santoso')" class="bg-primary text-white px-3 py-1 rounded text-sm mt-1">Bayar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div id="paymentForm" class="hidden">
                <h4 class="font-semibold mb-4">Form Pembayaran</h4>
                <form action="proses_pembayaran.php" method="POST">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pasien</label>
                            <input type="text" id="paymentPatient" name="pasien" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Total Bayar</label>
                            <input type="text" name="total" value="Rp 150.000" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                            <select name="metode" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                                <option value="Cash">Cash</option>
                                <option value="Transfer">Transfer</option>
                                <option value="QRIS">QRIS</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700">
                            Proses Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>