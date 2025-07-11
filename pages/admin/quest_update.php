<?php
include __DIR__ . '../../db.php';

// Ambil ID quest dari URL
$id_quest = $_GET['id'] ?? null;
if (!$id_quest) {
    die("ID quest tidak ditemukan.");
}

// Ambil data quest
$query = "SELECT * FROM quests WHERE id_quest = $id_quest";
$result = mysqli_query($koneksi, $query);
$quest = mysqli_fetch_assoc($result);

if (!$quest) {
    die("Quest tidak ditemukan.");
}

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $xp_reward = (int)$_POST['xp_reward'];
    $coin_reward = (int)$_POST['coin_reward'];
    $tersedia = isset($_POST['tersedia']) ? 1 : 0;

    // Proses upload file gambar_icon
    if (isset($_FILES['gambar_icon']) && $_FILES['gambar_icon']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'assets/images/';
        $ext = strtolower(pathinfo($_FILES['gambar_icon']['name'], PATHINFO_EXTENSION));
        $allowed = ['png', 'jpg', 'jpeg'];
        if (in_array($ext, $allowed)) {
            $filename = uniqid('quest_icon_', true) . '.' . $ext;
            $targetPath = $uploadDir . $filename;
            move_uploaded_file($_FILES['gambar_icon']['tmp_name'], $targetPath);
            $gambar_icon = $filename;
        } else {
            $gambar_icon = $quest['gambar_icon'];
        }
    } else {
        $gambar_icon = $quest['gambar_icon'];
    }

    $update = "UPDATE quests SET 
        judul='$judul',
        kategori='$kategori',
        deskripsi='$deskripsi',
        xp_reward=$xp_reward,
        coin_reward=$coin_reward,
        gambar_icon='$gambar_icon',
        tersedia=$tersedia
        WHERE id_quest = $id_quest";

    if (mysqli_query($koneksi, $update)) {
        header("Location: index.php?modul=quest&fitur=list");
        exit;
    } else {
        $error = "Gagal mengupdate quest.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Quest</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<?php include 'includes/navbar.php'; ?>
<div class="flex">
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 p-8">
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Quest</h2>

            <?php if (!empty($error)): ?>
                <div class="text-red-600 mb-4"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                <!-- Judul -->
                <div class="mb-4">
                    <label for="judul" class="block text-gray-700 text-sm font-bold mb-2">Judul</label>
                    <input type="text" id="judul" name="judul"
                           value="<?php echo htmlspecialchars($quest['judul']); ?>"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" required>
                </div>

                <!-- Kategori -->
                <div class="mb-4">
                    <label for="kategori" class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                    <input type="text" id="kategori" name="kategori"
                           value="<?php echo htmlspecialchars($quest['kategori']); ?>"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" required>
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                              rows="3" required><?php echo htmlspecialchars($quest['deskripsi']); ?></textarea>
                </div>

                <!-- XP Reward -->
                <div class="mb-4">
                    <label for="xp_reward" class="block text-gray-700 text-sm font-bold mb-2">XP Reward</label>
                    <input type="number" id="xp_reward" name="xp_reward"
                           value="<?php echo $quest['xp_reward']; ?>"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                           min="0" required>
                </div>

                <!-- Coin Reward -->
                <div class="mb-4">
                    <label for="coin_reward" class="block text-gray-700 text-sm font-bold mb-2">Coin Reward</label>
                    <input type="number" id="coin_reward" name="coin_reward"
                           value="<?php echo $quest['coin_reward']; ?>"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                           min="0" required>
                </div>

                <!-- Gambar Icon -->
                <div class="mb-4">
                    <label for="gambar_icon" class="block text-gray-700 text-sm font-bold mb-2">Upload Icon (PNG/JPG/JPEG)</label>
                    <input type="file" id="gambar_icon" name="gambar_icon" accept="image/png, image/jpeg, image/jpg"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight">
                    <?php if (!empty($quest['gambar_icon'])): ?>
                        <div class="mt-2">
                            <span class="text-xs text-gray-500">Icon saat ini:</span><br>
                            <img src="assets/images/<?php echo htmlspecialchars($quest['gambar_icon']); ?>" alt="icon" class="h-12">
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Tersedia -->
                <div class="mb-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="tersedia" value="1" class="form-checkbox"
                               <?php echo $quest['tersedia'] ? 'checked' : ''; ?>>
                        <span class="ml-2 text-gray-700">Tersedia</span>
                    </label>
                </div>

                <!-- Tombol -->
                <div class="flex justify-between">
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Simpan Perubahan
                    </button>
                    <a href="index.php?modul=quest&fitur=list"
                       class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
