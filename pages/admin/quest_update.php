<?php
include 'pages/db.php';

// Ambil ID quest dari URL
$id_quest = $_GET['id'] ?? null;

if (!$id_quest) {
    die("ID quest tidak ditemukan.");
}

// Ambil data quest dari database
$query = "SELECT * FROM quests WHERE id_quest = $id_quest";
$result = mysqli_query($koneksi, $query);
$quest = mysqli_fetch_assoc($result);

if (!$quest) {
    die("Data quest tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Edit Quest</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <?php include 'includes/navbar.php'; ?>
    <div class="flex">
        <?php include 'includes/sidebar.php'; ?>

        <div class="flex-1 p-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Edit Quest</h2>

            <form action="index.php?modul=quest&fitur=edit&id=<?php echo $quest['id_quest']; ?>" method="POST" class="bg-white p-6 rounded shadow-md w-full max-w-xl">
                <!-- Judul -->
                <div class="mb-4">
                    <label for="judul" class="block text-gray-700 font-semibold mb-1">Judul Quest</label>
                    <input type="text" name="judul" id="judul" class="w-full p-2 border border-gray-300 rounded" required value="<?php echo htmlspecialchars($quest['judul']); ?>">
                </div>

                <!-- Kategori -->
                <div class="mb-4">
                    <label for="kategori" class="block text-gray-700 font-semibold mb-1">Kategori</label>
                    <select name="kategori" id="kategori" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="story" <?php if($quest['kategori'] == 'story') echo 'selected'; ?>>Story</option>
                        <option value="daily" <?php if($quest['kategori'] == 'daily') echo 'selected'; ?>>Daily</option>
                        <option value="challenge" <?php if($quest['kategori'] == 'challenge') echo 'selected'; ?>>Challenge</option>
                    </select>
                </div>

                <!-- XP Reward -->
                <div class="mb-4">
                    <label for="xp_reward" class="block text-gray-700 font-semibold mb-1">XP Reward</label>
                    <input type="number" name="xp_reward" id="xp_reward" class="w-full p-2 border border-gray-300 rounded" min="0" required value="<?php echo $quest['xp_reward']; ?>">
                </div>

                <!-- Coin Reward -->
                <div class="mb-4">
                    <label for="coin_reward" class="block text-gray-700 font-semibold mb-1">Coin Reward</label>
                    <input type="number" name="coin_reward" id="coin_reward" class="w-full p-2 border border-gray-300 rounded" min="0" required value="<?php echo $quest['coin_reward']; ?>">
                </div>

                <!-- Gambar Icon -->
                <div class="mb-4">
                    <label for="gambar_icon" class="block text-gray-700 font-semibold mb-1">Nama File Icon (mis: clue.png)</label>
                    <input type="text" name="gambar_icon" id="gambar_icon" class="w-full p-2 border border-gray-300 rounded" required value="<?php echo htmlspecialchars($quest['gambar_icon']); ?>">
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label for="deskripsi" class="block text-gray-700 font-semibold mb-1">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full p-2 border border-gray-300 rounded"><?php echo htmlspecialchars($quest['deskripsi']); ?></textarea>
                </div>

                <!-- Submit -->
                <div class="mt-6">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Simpan Perubahan
                    </button>
                    <a href="index.php?modul=quest&fitur=list" class="ml-4 text-blue-600 hover:underline">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
