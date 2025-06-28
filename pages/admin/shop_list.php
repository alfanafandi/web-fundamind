<?php
session_start();
include __DIR__ . '../../db.php';

// Ambil semua item dari database yang tersedia
$query = "SELECT id_item, nama_item, tipe_item, deskripsi, harga_coin, file_icon, tersedia FROM shop_items WHERE tersedia = 1 ORDER BY id_item ASC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Item Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <?php include 'includes/navbar.php'; ?>

    <div class="flex">
        <?php include 'includes/sidebar.php'; ?>

        <div class="flex-1 p-8">
            <div class="container mx-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Item Shop</h2>
                    <a href="index.php?modul=shop&fitur=create" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        + Tambah Item
                    </a>
                </div>

                <div class="bg-white shadow-md rounded overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-800 text-white text-sm uppercase">
                            <tr>
                                <th class="px-4 py-3">Icon</th>
                                <th class="px-4 py-3 text-left">Nama Item</th>
                                <th class="px-4 py-3 text-left">Tipe</th>
                                <th class="px-4 py-3 text-left">Deskripsi</th>
                                <th class="px-4 py-3 text-center">Harga (Coin)</th>
                                <th class="px-4 py-3 text-center">Tersedia</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">
                            <?php while ($item = mysqli_fetch_assoc($result)) : ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 text-center">
                                        <img src="<?php echo 'assets/images/' . htmlspecialchars($item['file_icon']); ?>" alt="icon" class="h-10 mx-auto">
                                    </td>
                                    <td class="px-4 py-3"><?php echo htmlspecialchars($item['nama_item']); ?></td>
                                    <td class="px-4 py-3"><?php echo htmlspecialchars($item['tipe_item']); ?></td>
                                    <td class="px-4 py-3"><?php echo htmlspecialchars($item['deskripsi']); ?></td>
                                    <td class="px-4 py-3 text-center"><?php echo $item['harga_coin']; ?></td>
                                    <td class="px-4 py-3 text-center">
                                        <?php echo $item['tersedia'] == 1 ? 'Ya' : 'Tidak'; ?>
                                    </td>
                                    <td class="px-4 py-3 text-center space-x-2">
                                        <a href="index.php?modul=shop&fitur=edit&id=<?php echo $item['id_item']; ?>" class="text-blue-600 hover:underline">Edit</a>
                                        <a href="index.php?modul=shop&fitur=delete&id=<?php echo $item['id_item']; ?>" onclick="return confirm('Yakin ingin menghapus item ini?')" class="text-red-600 hover:underline">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>