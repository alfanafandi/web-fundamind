<?php
include __DIR__ . '../../db.php';

// Ambil ID item dari URL
$id_item = $_GET['id'] ?? null;

if (!$id_item) {
    die("ID item tidak ditemukan.");
}

// Ambil data item
$query = "SELECT * FROM shop_items WHERE id_item = $id_item";
$result = mysqli_query($koneksi, $query);
$item = mysqli_fetch_assoc($result);

if (!$item) {
    die("Item tidak ditemukan.");
}

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_item = $_POST['nama_item'];
    $tipe_item = $_POST['tipe_item'];
    $deskripsi = $_POST['deskripsi'];
    $harga_coin = (int)$_POST['harga_coin'];
    $tersedia = isset($_POST['tersedia']) ? 1 : 0;

    // Proses upload file icon jika ada file baru
    if (isset($_FILES['file_icon']) && $_FILES['file_icon']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'assets/images/';
        $ext = strtolower(pathinfo($_FILES['file_icon']['name'], PATHINFO_EXTENSION));
        $allowed = ['png', 'jpg', 'jpeg'];
        if (in_array($ext, $allowed)) {
            $filename = uniqid('icon_', true) . '.' . $ext;
            $targetPath = $uploadDir . $filename;
            move_uploaded_file($_FILES['file_icon']['tmp_name'], $targetPath);
            $file_icon = $filename;
        } else {
            $file_icon = $item['file_icon'];
        }
    } else {
        $file_icon = $item['file_icon'];
    }

    $update = "UPDATE shop_items SET 
        nama_item='$nama_item',
        tipe_item='$tipe_item',
        deskripsi='$deskripsi',
        harga_coin=$harga_coin,
        file_icon='$file_icon',
        tersedia=$tersedia
        WHERE id_item = $id_item";

    if (mysqli_query($koneksi, $update)) {
        header("Location: index.php?modul=shop&fitur=list");
        exit;
    } else {
        $error = "Gagal mengupdate item.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Item Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<?php include 'includes/navbar.php'; ?>
<div class="flex">
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 p-8">
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Item Shop</h2>

            <?php if (!empty($error)): ?>
                <div class="text-red-600 mb-4"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data">
                <!-- Nama Item -->
                <div class="mb-4">
                    <label for="nama_item" class="block text-gray-700 text-sm font-bold mb-2">Nama Item</label>
                    <input type="text" id="nama_item" name="nama_item"
                           value="<?php echo htmlspecialchars($item['nama_item']); ?>"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight">
                </div>

                <!-- Tipe Item -->
                <div class="mb-4">
                    <label for="tipe_item" class="block text-gray-700 text-sm font-bold mb-2">Tipe Item</label>
                    <input type="text" id="tipe_item" name="tipe_item"
                           value="<?php echo htmlspecialchars($item['tipe_item']); ?>"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight">
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                              rows="3"><?php echo htmlspecialchars($item['deskripsi']); ?></textarea>
                </div>

                <!-- Harga Coin -->
                <div class="mb-4">
                    <label for="harga_coin" class="block text-gray-700 text-sm font-bold mb-2">Harga (Coin)</label>
                    <input type="number" id="harga_coin" name="harga_coin"
                           value="<?php echo $item['harga_coin']; ?>"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                           min="0">
                </div>

                <!-- File Icon -->
                <div class="mb-4">
                    <label for="file_icon" class="block text-gray-700 text-sm font-bold mb-2">Upload Icon (PNG/JPG/JPEG)</label>
                    <input type="file" id="file_icon" name="file_icon" accept="image/png, image/jpeg, image/jpg"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight">
                    <?php if (!empty($item['file_icon'])): ?>
                        <div class="mt-2">
                            <span class="text-xs text-gray-500">Icon saat ini:</span><br>
                            <img src="assets/images/<?php echo htmlspecialchars($item['file_icon']); ?>" alt="icon" class="h-12">
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Tersedia -->
                <div class="mb-6">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="tersedia" value="1" class="form-checkbox"
                               <?php echo $item['tersedia'] ? 'checked' : ''; ?>>
                        <span class="ml-2 text-gray-700">Tersedia</span>
                    </label>
                </div>

                <!-- Tombol -->
                <div class="flex justify-between">
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Simpan Perubahan
                    </button>
                    <a href="index.php?modul=shop&fitur=list"
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
</body>
</html>
