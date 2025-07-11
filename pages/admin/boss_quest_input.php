<?php
include 'pages/db.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Boss Quest</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <?php include 'includes/navbar.php'; ?>
    <div class="flex">
        <?php include 'includes/sidebar.php'; ?>

        <div class="flex-1 p-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Tambah Boss Quest</h2>

            <form action="index.php?modul=boss_quest&fitur=create" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md w-full max-w-xl">
                <div class="mb-4">
                    <label for="id_quest" class="block text-gray-700 font-semibold mb-1">ID Quest</label>
                    <input type="number" name="id_quest" id="id_quest" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="nama_boss" class="block text-gray-700 font-semibold mb-1">Nama Boss</label>
                    <input type="text" name="nama_boss" id="nama_boss" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="chapter_start" class="block text-gray-700 font-semibold mb-1">Chapter Start</label>
                    <input type="number" name="chapter_start" id="chapter_start" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="chapter_end" class="block text-gray-700 font-semibold mb-1">Chapter End</label>
                    <input type="number" name="chapter_end" id="chapter_end" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="deskripsi_boss" class="block text-gray-700 font-semibold mb-1">Deskripsi Boss</label>
                    <textarea name="deskripsi_boss" id="deskripsi_boss" rows="3" class="w-full p-2 border border-gray-300 rounded"></textarea>
                </div>
                <div class="mb-4">
                    <label for="background_image" class="block text-gray-700 font-semibold mb-1">Upload Background Image</label>
                    <input type="file" name="background_image" id="background_image" accept="image/png, image/jpeg, image/jpg" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="boss_image" class="block text-gray-700 font-semibold mb-1">Upload Boss Image</label>
                    <input type="file" name="boss_image" id="boss_image" accept="image/png, image/jpeg, image/jpg" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="xp_reward" class="block text-gray-700 font-semibold mb-1">XP Reward</label>
                    <input type="number" name="xp_reward" id="xp_reward" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="coin_reward" class="block text-gray-700 font-semibold mb-1">Coin Reward</label>
                    <input type="number" name="coin_reward" id="coin_reward" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mt-6">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                        Simpan Boss Quest
                    </button>
                    <a href="index.php?modul=boss_quest&fitur=list" class="ml-4 text-blue-600 hover:underline">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
