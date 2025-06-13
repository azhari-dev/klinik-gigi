<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi - Klinik Gigi Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0891b2',
                        secondary: '#06b6d4'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <?php include 'includes/navbar.php'; ?>
    
    <div class="max-w-4xl mx-auto p-6 py-16">
        <h2 class="text-3xl font-bold text-center mb-8">Buat Reservasi</h2>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <form id="reservationForm" action="proses_reservasi.php" method="POST">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">No. HP</label>
                        <input type="tel" name="no_hp" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Layanan</label>
                        <select name="layanan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                            <option value="">Pilih Layanan</option>
                            <option value="konsultasi">Konsultasi - Rp 50.000</option>
                            <option value="scaling">Scaling - Rp 150.000</option>
                            <option value="tambal">Tambal Gigi - Rp 100.000</option>
                            <option value="behel">Pemasangan Behel - Rp 500.000</option>
                            <option value="cabut">Cabut Gigi - Rp 75.000</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Reservasi</label>
                        <input type="date" name="tanggal_reservasi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jam Reservasi</label>
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
                </div>
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                    <textarea name="alamat" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
                </div>
                <div class="mt-6 text-center">
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

    <?php include 'includes/footer.php'; ?>
</body>
</html>