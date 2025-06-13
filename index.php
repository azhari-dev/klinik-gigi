<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Gigi Sehat</title>
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

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-primary to-secondary text-white py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-4">Selamat Datang di Klinik Gigi Sehat</h2>
            <p class="text-xl mb-8">Perawatan gigi terbaik dengan dokter berpengalaman</p>
            <a href="reservasi.php" class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 inline-block">
                Buat Reservasi Sekarang
            </a>
        </div>
    </div>

    <!-- Services Section -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <h2 class="text-3xl font-bold text-center mb-12">Layanan Kami</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <div class="text-4xl mb-4">👨‍⚕️</div>
                <h3 class="text-xl font-semibold mb-2">Dokter Berpengalaman</h3>
                <p class="text-gray-600">Tim dokter gigi profesional dengan pengalaman bertahun-tahun</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <div class="text-4xl mb-4">🏥</div>
                <h3 class="text-xl font-semibold mb-2">Fasilitas Modern</h3>
                <p class="text-gray-600">Peralatan medis terkini untuk perawatan optimal</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <div class="text-4xl mb-4">📱</div>
                <h3 class="text-xl font-semibold mb-2">Reservasi Online</h3>
                <p class="text-gray-600">Mudah dan praktis untuk membuat janji temu</p>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>

</html>