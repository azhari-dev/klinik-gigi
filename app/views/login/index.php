<form action="<?= BASEURL ?>/login/authenticate" method="POST" class="space-y-4">
    <div>
        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
        <input type="text" name="username" id="username" required
               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none">
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" id="password" required
               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none">
    </div>

    <div>
        <button type="submit"
                class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md">
            Masuk
        </button>
    </div>
    <?php if (isset($_GET['error'])): ?>
        <p class="text-red-500 text-sm text-center">Username atau password salah!</p>
    <?php endif; ?>
</form>