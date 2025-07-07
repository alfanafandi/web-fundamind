<?php
include 'pages/db.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tambah Quest Chapter</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <?php include 'includes/navbar.php'; ?>
    <div class="flex">
        <?php include 'includes/sidebar.php'; ?>

        <div class="flex-1 p-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Tambah Quest Chapter</h2>

            <form action="index.php?modul=quest_chapter&fitur=create" method="POST" class="bg-white p-6 rounded shadow-md w-full max-w-xl">
                <!-- ID Quest -->
                <div class="mb-4">
                    <label for="id_quest" class="block text-gray-700 font-semibold mb-1">ID Quest</label>
                    <input type="number" name="id_quest" id="id_quest" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <!-- Nomor Chapter -->
                <div class="mb-4">
                    <label for="nomor_chapter" class="block text-gray-700 font-semibold mb-1">Nomor Chapter</label>
                    <input type="number" name="nomor_chapter" id="nomor_chapter" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <!-- Judul Chapter -->
                <div class="mb-4">
                    <label for="judul_chapter" class="block text-gray-700 font-semibold mb-1">Judul Chapter</label>
                    <input type="text" name="judul_chapter" id="judul_chapter" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <!-- Deskripsi -->
                <div class="mb-4">
                    <label for="deskripsi" class="block text-gray-700 font-semibold mb-1">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full p-2 border border-gray-300 rounded"></textarea>
                </div>
                <!-- Coin Reward -->
                <div class="mb-4">
                    <label for="coin_reward" class="block text-gray-700 font-semibold mb-1">Coin Reward</label>
                    <input type="number" name="coin_reward" id="coin_reward" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <!-- XP Reward -->
                <div class="mb-4">
                    <label for="xp_reward" class="block text-gray-700 font-semibold mb-1">XP Reward</label>
                    <input type="number" name="xp_reward" id="xp_reward" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <!-- Tombol Aksi -->
                <div class="mt-6">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                        Simpan Chapter
                    </button>
                    <a href="index.php?modul=quest_chapter&fitur=list" class="ml-4 text-blue-600 hover:underline">Kembali</a>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
