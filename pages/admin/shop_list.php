<?php
session_start();
include __DIR__ . '../../db.php';

$perPage = 10;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $perPage;

$totalResult = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM shop_items WHERE tersedia = 1");
$totalRows = mysqli_fetch_assoc($totalResult)['total'];
$totalPages = ceil($totalRows / $perPage);

$query = "SELECT id_item, nama_item, tipe_item, deskripsi, harga_coin, file_icon, tersedia, level_minimal, sekali_pakai FROM shop_items WHERE tersedia = 1 ORDER BY id_item ASC LIMIT $perPage OFFSET $offset";
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
                    <table class="min-w-full table-auto text-sm">
                        <thead class="bg-gray-800 text-white uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3">Icon</th>
                                <th class="px-4 py-3 text-left">Nama Item</th>
                                <th class="px-4 py-3 text-left">Tipe</th>
                                <th class="px-4 py-3 text-left">Deskripsi</th>
                                <th class="px-4 py-3 text-center">Harga (Coin)</th>
                                <th class="px-4 py-3 text-center">Level Min</th>
                                <th class="px-4 py-3 text-center">Sekali Pakai</th>
                                <th class="px-4 py-3 text-center">Tersedia</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            <?php while ($item = mysqli_fetch_assoc($result)) : ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 text-center">
                                        <img src="assets/images/<?php echo htmlspecialchars($item['file_icon']); ?>" alt="icon" class="h-10 mx-auto">
                                    </td>
                                    <td class="px-4 py-3"><?php echo htmlspecialchars($item['nama_item']); ?></td>
                                    <td class="px-4 py-3"><?php echo htmlspecialchars($item['tipe_item']); ?></td>
                                    <td class="px-4 py-3"><?php echo htmlspecialchars($item['deskripsi']); ?></td>
                                    <td class="px-4 py-3 text-center"><?php echo $item['harga_coin']; ?></td>
                                    <td class="px-4 py-3 text-center"><?php echo $item['level_minimal']; ?></td>
                                    <td class="px-4 py-3 text-center"><?php echo $item['sekali_pakai'] ? 'Ya' : 'Tidak'; ?></td>
                                    <td class="px-4 py-3 text-center"><?php echo $item['tersedia'] ? 'Ya' : 'Tidak'; ?></td>
                                    <td class="px-4 py-3 text-center space-x-2">
                                        <a href="index.php?modul=shop&fitur=edit&id=<?php echo $item['id_item']; ?>" class="text-blue-600 hover:underline">Edit</a>
                                        <a href="index.php?modul=shop&fitur=delete&id=<?php echo $item['id_item']; ?>" onclick="return confirm('Yakin ingin menghapus item ini?')" class="text-red-600 hover:underline">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4 flex justify-center space-x-2">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?modul=shop&fitur=list&page=<?php echo $i; ?>"
                           class="px-3 py-1 rounded <?php echo $i == $page ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700'; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
