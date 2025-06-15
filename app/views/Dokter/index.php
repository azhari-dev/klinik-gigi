<h2 class="text-3xl font-bold text-center mb-8">Panel Dokter</h2>

<div class="flex justify-center mb-8">
    <div class="bg-white rounded-lg shadow-md p-2 flex space-x-2">
        <?php
        $tabs = ['antrian', 'pemeriksaan', 'riwayat'];
        foreach ($tabs as $item):
        ?>
            <a href="<?= BASEURL ?>/dokter/index/<?= $item ?>"
               class="px-4 py-2 rounded <?= $data['tab'] === $item ? 'bg-primary text-white' : 'text-gray-600 hover:bg-gray-100' ?>">
                <?= ucfirst($item) ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<div class="bg-white p-6 rounded-lg shadow-md">
    <?php
    if ($data['tab'] === 'antrian') {
        require_once __DIR__ . '/antrian.php';
    } elseif ($data['tab'] === 'pemeriksaan') {
        require_once __DIR__ . '/pemeriksaan.php';
    } elseif ($data['tab'] === 'riwayat') {
        require_once __DIR__ . '/riwayat.php';
    }
    ?>
</div>
