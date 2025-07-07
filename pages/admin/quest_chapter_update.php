<?php
include 'pages/db.php';

// Ambil ID chapter dari URL
$id_chapter = $_GET['id'] ?? null;

if (!$id_chapter) {
    die("ID chapter tidak ditemukan.");
}

// Ambil data chapter dari database
$query = "SELECT * FROM quest_chapters WHERE id_chapter = $id_chapter";
$result = mysqli_query($koneksi, $query);
$chapter = mysqli_fetch_assoc($result);

if (!$chapter) {
    die("Data chapter tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Edit Quest Chapter</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <?php include 'includes/navbar.php'; ?>
    <div class="flex">
        <?php include 'includes/sidebar.php'; ?>

        <div class="flex-1 p-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Edit Quest Chapter</h2>

            <form action="index.php?modul=quest_chapter&fitur=edit&id=<?php echo $chapter['id_chapter']; ?>" method="POST" class="bg-white p-6 rounded shadow-md w-full max-w-xl">
                <!-- ID Quest -->
                <div class="mb-4">
                    <label for="id_quest" class="block text-gray-700 font-semibold mb-1">ID Quest</label>
                    <input type="number" name="id_quest" id="id_quest" class="w-full p-2 border border-gray-300 rounded" required value="<?php echo $chapter['id_quest']; ?>">
                </div>
                <!-- Nomor Chapter -->
                <div class="mb-4">
                    <label for="nomor_chapter" class="block text-gray-700 font-semibold mb-1">Nomor Chapter</label>
                    <input type="number" name="nomor_chapter" id="nomor_chapter" class="w-full p-2 border border-gray-300 rounded" required value="<?php echo $chapter['nomor_chapter']; ?>">
                </div>
                <!-- Judul Chapter -->
                <div class="mb-4">
                    <label for="judul_chapter" class="block text-gray-700 font-semibold mb-1">Judul Chapter</label>
                    <input type="text" name="judul_chapter" id="judul_chapter" class="w-full p-2 border border-gray-300 rounded" required value="<?php echo htmlspecialchars($chapter['judul_chapter']); ?>">
                </div>
                <!-- Deskripsi -->
                <div class="mb-4">
                    <label for="deskripsi" class="block text-gray-700 font-semibold mb-1">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full p-2 border border-gray-300 rounded"><?php echo htmlspecialchars($chapter['deskripsi']); ?></textarea>
                </div>
                <!-- Coin Reward -->
                <div class="mb-4">
                    <label for="coin_reward" class="block text-gray-700 font-semibold mb-1">Coin Reward</label>
                    <input type="number" name="coin_reward" id="coin_reward" class="w-full p-2 border border-gray-300 rounded" required value="<?php echo $chapter['coin_reward']; ?>">
                </div>
                <!-- XP Reward -->
                <div class="mb-4">
                    <label for="xp_reward" class="block text-gray-700 font-semibold mb-1">XP Reward</label>
                    <input type="number" name="xp_reward" id="xp_reward" class="w-full p-2 border border-gray-300 rounded" required value="<?php echo $chapter['xp_reward']; ?>">
                </div>
                <!-- Submit -->
                <div class="mt-6">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Simpan Perubahan
                    </button>
                    <a href="index.php?modul=quest_chapter&fitur=list" class="ml-4 text-blue-600 hover:underline">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
