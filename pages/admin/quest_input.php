<?php
include 'pages/db.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Quest</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <?php include 'includes/navbar.php'; ?>
    <div class="flex">
        <?php include 'includes/sidebar.php'; ?>

        <div class="flex-1 p-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Tambah Quest</h2>

            <form action="index.php?modul=quest&fitur=create" method="POST" class="bg-white p-6 rounded shadow-md w-full max-w-xl">
                <!-- Judul Quest -->
                <div class="mb-4">
                    <label for="judul" class="block text-gray-700 font-semibold mb-1">Judul Quest</label>
                    <input type="text" name="judul" id="judul" class="w-full p-2 border border-gray-300 rounded" required>
                </div>

                <!-- Kategori -->
                <div class="mb-4">
                    <label for="kategori" class="block text-gray-700 font-semibold mb-1">Kategori</label>
                    <select name="kategori" id="kategori" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="story">Story</option>
                        <option value="daily">Daily</option>
                        <option value="challenge">Challenge</option>
                    </select>
                </div>

                <!-- XP Reward -->
                <div class="mb-4">
                    <label for="xp_reward" class="block text-gray-700 font-semibold mb-1">XP Reward</label>
                    <input type="number" name="xp_reward" id="xp_reward" class="w-full p-2 border border-gray-300 rounded" required>
                </div>

                <!-- Coin Reward -->
                <div class="mb-4">
                    <label for="coin_reward" class="block text-gray-700 font-semibold mb-1">Coin Reward</label>
                    <input type="number" name="coin_reward" id="coin_reward" class="w-full p-2 border border-gray-300 rounded" required>
                </div>

                <!-- Gambar Icon -->
                <div class="mb-4">
                    <label for="gambar_icon" class="block text-gray-700 font-semibold mb-1">Nama File Icon</label>
                    <input type="text" name="gambar_icon" id="gambar_icon" class="w-full p-2 border border-gray-300 rounded" required>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-6">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                        Simpan Quest
                    </button>
                    <a href="index.php?modul=quest&fitur=list" class="ml-4 text-blue-600 hover:underline">Kembali</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>