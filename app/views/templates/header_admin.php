<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Klinik Gigi Sehat</title>
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
    <nav class="bg-white shadow-lg mb-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center">
                <a href="../index.php" class="text-2xl font-bold text-primary">🦷 Klinik Gigi Sehat - Admin</a>
            </div>
            <div class="flex space-x-4">
                <a href="logout.php" class="bg-red-600 text-white px-4 py-2 rounded">Logout</a>
            </div>
        </div>
    </div>
</nav>