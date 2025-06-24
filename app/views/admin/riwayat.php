<div class="p-6">
    <h3 class="text-xl font-semibold mb-4">Riwayat Transaksi</h3>
    <div class="overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-primary text-white">
                <th class="px-4 py-2 text-left">Tanggal</th>
                <th class="px-4 py-2 text-left">Pasien</th>
                <th class="px-4 py-2 text-left">Layanan</th>
                <th class="px-4 py-2 text-left">Tagihan</th>
                <th class="px-4 py-2 text-left">Terbayar</th>
                <th class="px-4 py-2 text-left">Status</th>
            </tr>
        </thead>
            <tbody>
                <?php if (!empty($data['riwayat'])): ?>
                    <?php foreach ($data['riwayat'] as $row): ?>
                        <tr class="border-b">
                            <td class="px-4 py-2"><?= htmlspecialchars($row['tanggal_pemeriksaan']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($row['nama_pasien']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($row['nama_layanan']) ?></td>
                            <td class="px-4 py-2 text-green-600 font-semibold">Rp <?= number_format($row['harus_dibayar']) ?></td>
                            <td class="px-4 py-2 font-semibold 
                                <?= ($row['total_bayar'] >= $row['harus_dibayar']) ? 'text-green-600' : 'text-red-600' ?>">
                                Rp <?= number_format($row['total_bayar']) ?>
                            </td>
                            <td class="px-4 py-2">
                                <?php if ($row['status_id'] == 2 || $row['total_bayar'] >= $row['harus_dibayar']): ?>
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm font-semibold">Lunas</span>
                                <?php else: ?>
                                    <button
                                        onclick="showPaymentModal(
                                            '<?= htmlspecialchars($row['nama_pasien'], ENT_QUOTES) ?>',
                                            '<?= htmlspecialchars($row['nama_layanan'], ENT_QUOTES) ?>',
                                            <?= (int)$row['harus_dibayar'] ?>,
                                            <?= (int)$row['pemeriksaan_id'] ?>,
                                            <?= (int)$row['total_bayar'] ?>
                                        )"
                                        class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-sm"
                                        type="button"
                                    >
                                        Pelunasan
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 px-4 py-4">Belum ada transaksi pembayaran.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Pelunasan -->
<div id="paymentModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md relative">
        <button onclick="closePaymentModal()" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;</button>
        <h4 class="font-semibold mb-4">Form Pelunasan</h4>
        <form id="pelunasanForm" action="<?= BASEURL ?>/admin/prosesPelunasan" method="POST">
            <input type="hidden" name="pemeriksaan_id" id="modalPemeriksaanId">
            <input type="hidden" id="modalTotalBayarSebelumnya" value="0">
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
                    <p id="warningBayar" class="text-red-600 text-sm mt-1 hidden">Total bayar tidak boleh lebih besar dari tagihan!</p>
                </div>
                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700">
                    Proses Pembayaran
                </button>
            </div>
        </form>
    </div>
</div>
<!-- End Modal -->

<script>
let tagihanModal = 0;
function showPaymentModal(pasien, layanan, harga, pemeriksaan_id, total_bayar) {
    document.getElementById('modalPatient').value = pasien;
    document.getElementById('modalLayanan').value = layanan;
    document.getElementById('modalHarga').value = 'Rp ' + Number(harga).toLocaleString('id-ID');
    document.getElementById('modalTotal').value = '';
    document.getElementById('modalPemeriksaanId').value = pemeriksaan_id;
    document.getElementById('modalTotalBayarSebelumnya').value = total_bayar;
    tagihanModal = Number(harga);
    document.getElementById('warningBayar').classList.add('hidden');
    document.getElementById('paymentModal').classList.remove('hidden');
}
function closePaymentModal() {
    document.getElementById('paymentModal').classList.add('hidden');
}

// Validasi pelunasan
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('pelunasanForm');
    const totalInput = document.getElementById('modalTotal');
    const totalSebelumnyaInput = document.getElementById('modalTotalBayarSebelumnya');
    const warning = document.getElementById('warningBayar');
    if(form && totalInput && totalSebelumnyaInput) {
        form.addEventListener('submit', function(e) {
            const totalSebelumnya = Number(totalSebelumnyaInput.value) || 0;
            const totalSekarang = Number(totalInput.value) || 0;
            if((totalSebelumnya + totalSekarang) > tagihanModal) {
                warning.classList.remove('hidden');
                totalInput.focus();
                e.preventDefault();
            }
        });
        totalInput.addEventListener('input', function() {
            const totalSebelumnya = Number(totalSebelumnyaInput.value) || 0;
            const totalSekarang = Number(totalInput.value) || 0;
            if((totalSebelumnya + totalSekarang) > tagihanModal) {
                warning.classList.remove('hidden');
            } else {
                warning.classList.add('hidden');
            }
        });
    }
});
</script>
