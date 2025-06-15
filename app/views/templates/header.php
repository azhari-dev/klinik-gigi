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
<body class="bg-gray-50 min-h-screen flex flex-col">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-primary">Klinik Gigi Sehat</h1>
            <nav class="space-x-4 text-sm">
                <a href="<?= BASEURL ?>/home" class="hover:text-primary">Beranda</a>
                <a href="<?= BASEURL ?>/jadwal" class="hover:text-primary">Jadwal</a>
                <a href="<?= BASEURL ?>/reservasi" class="hover:text-primary">Reservasi</a>
                <a href="<?= BASEURL ?>/riwayat" class="hover:text-primary">Riwayat</a>
            </nav>
        </div>
    </header>
    <main class="min-h-screen">
