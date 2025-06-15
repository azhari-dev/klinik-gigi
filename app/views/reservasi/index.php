<div class="max-w-4xl mx-auto p-6 py-16">
        <h2 class="text-3xl font-bold text-center mb-8">Buat Reservasi</h2>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <form id="reservationForm" action="proses_reservasi.php" method="POST">
                <label class="block text-sm font-medium text-gray-700 mb-2">Layanan</label>
                <div class="grid mb-4 gap-6">
                    <select name="layanan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                        <option value="">Pilih Layanan</option>
                        <option value="konsultasi">Konsultasi - Rp 50.000</option>
                        <option value="scaling">Scaling - Rp 150.000</option>
                        <option value="tambal">Tambal Gigi - Rp 100.000</option>
                        <option value="behel">Pemasangan Behel - Rp 500.000</option>
                        <option value="cabut">Cabut Gigi - Rp 75.000</option>
                    </select>
                </div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Reservasi</label>
                <div class="grid mb-4 gap-6">
                    <input type="date" name="tanggal_reservasi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                </div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jam Reservasi</label>
                <div class="grid mb-4 gap-6">
                    <select name="jam_reservasi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                        <option value="">Pilih Jam</option>
                        <option value="08:00">08:00</option>
                        <option value="09:00">09:00</option>
                        <option value="10:00">10:00</option>
                        <option value="11:00">11:00</option>
                        <option value="13:00">13:00</option>
                        <option value="14:00">14:00</option>
                        <option value="15:00">15:00</option>
                        <option value="16:00">16:00</option>
                    </select>
                </div>
                <div class="mt-6 text-center gap-6">
                    <button type="submit" class="bg-primary text-white px-8 py-3 rounded-lg font-semibold hover:bg-cyan-700">
                        Buat Reservasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.querySelector('input[name="tanggal_reservasi"]').setAttribute('min', today);
        });
    </script>