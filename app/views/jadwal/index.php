<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Dokter - Klinik Gigi Sehat</title>
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
    <?php require_once '../app/views/layouts/header.php'; ?>
    
    <div class="max-w-6xl mx-auto p-6 py-16">
        <h2 class="text-3xl font-bold text-center mb-8">Jadwal Dokter</h2>
        
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center mb-4">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center text-white text-2xl font-bold">
                        DR
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-semibold">Dr. Sarah Wijaya</h3>
                        <p class="text-gray-600">Spesialis Ortodonti</p>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span>Senin - Rabu</span>
                        <span class="font-semibold">08:00 - 12:00</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Jumat</span>
                        <span class="font-semibold">13:00 - 17:00</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center mb-4">
                    <div class="w-16 h-16 bg-secondary rounded-full flex items-center justify-center text-white text-2xl font-bold">
                        DR
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-semibold">Dr. Ahmad Fauzi</h3>
                        <p class="text-gray-600">Dokter Gigi Umum</p>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span>Selasa - Kamis</span>
                        <span class="font-semibold">08:00 - 12:00</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Sabtu</span>
                        <span class="font-semibold">09:00 - 13:00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once '../app/views/layouts/footer.php'; ?>
</body>
</html>