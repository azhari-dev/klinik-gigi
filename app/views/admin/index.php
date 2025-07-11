<h2 class="text-3xl font-bold text-center mb-8">Panel Admin</h2>

<div class="flex justify-center mb-8">
    <div class="bg-white rounded-lg shadow-md p-2 flex space-x-2">
        <?php
        $tabs = ['antrian', 'pembayaran', 'riwayat'];
        foreach ($tabs as $item):
        ?>
            <a href="<?= BASEURL ?>/admin/index/<?= $item ?>"
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
    } elseif ($data['tab'] === 'pembayaran') {
        require_once __DIR__ . '/pembayaran.php';
    } elseif ($data['tab'] === 'riwayat') {
        require_once __DIR__ . '/riwayat.php';
    }
    ?>
</div>
