<?php
session_start();
include __DIR__ . '../../db.php';

$perPage = 10;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $perPage;

$totalResult = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM boss_quests");
$totalRows = mysqli_fetch_assoc($totalResult)['total'];
$totalPages = ceil($totalRows / $perPage);

$query = "SELECT id_boss, id_quest, nama_boss, chapter_start, chapter_end, deskripsi_boss, background_image, boss_image, xp_reward, coin_reward FROM boss_quests ORDER BY id_boss ASC LIMIT $perPage OFFSET $offset";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Boss Quest</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <?php include 'includes/navbar.php'; ?>

    <div class="flex">
        <?php include 'includes/sidebar.php'; ?>

        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Daftar Boss Quest</h2>
                <a href="index.php?modul=boss_quest&fitur=create" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    + Tambah Boss Quest
                </a>
            </div>

            <div class="bg-white shadow-md rounded overflow-x-auto">
                <table class="min-w-full table-auto text-sm">
                    <thead class="bg-gray-800 text-white uppercase">
                        <tr>
                            <th class="px-2 py-3 w-10 text-center">ID</th>
                            <th class="px-2 py-3 w-16 text-center">Quest</th>
                            <th class="px-2 py-3 w-32 text-left">Nama Boss</th>
                            <th class="px-2 py-3 w-16 text-center">Chapter Start</th>
                            <th class="px-2 py-3 w-16 text-center">Chapter End</th>
                            <th class="px-2 py-3 w-48 text-left">Deskripsi</th>
                            <th class="px-2 py-3 w-32 text-center">BG Image</th>
                            <th class="px-2 py-3 w-32 text-center">Boss Image</th>
                            <th class="px-2 py-3 w-16 text-center">XP</th>
                            <th class="px-2 py-3 w-16 text-center">Koin</th>
                            <th class="px-2 py-3 w-24 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php while ($boss = mysqli_fetch_assoc($result)) : ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-2 py-3 text-center"><?php echo $boss['id_boss']; ?></td>
                                <td class="px-2 py-3 text-center"><?php echo $boss['id_quest']; ?></td>
                                <td class="px-2 py-3"><?php echo htmlspecialchars($boss['nama_boss']); ?></td>
                                <td class="px-2 py-3 text-center"><?php echo $boss['chapter_start']; ?></td>
                                <td class="px-2 py-3 text-center"><?php echo $boss['chapter_end']; ?></td>
                                <td class="px-2 py-3 max-w-xs truncate"><?php echo htmlspecialchars($boss['deskripsi_boss']); ?></td>
                                <td class="px-2 py-3 text-center">
                                    <?php if ($boss['background_image']): ?>
                                        <img src="<?php echo 'assets/images/' . htmlspecialchars($boss['background_image']); ?>" alt="bg" class="h-10 mx-auto">
                                    <?php endif; ?>
                                </td>
                                <td class="px-2 py-3 text-center">
                                    <?php if ($boss['boss_image']): ?>
                                        <img src="<?php echo 'assets/images/' . htmlspecialchars($boss['boss_image']); ?>" alt="boss" class="h-10 mx-auto">
                                    <?php endif; ?>
                                </td>
                                <td class="px-2 py-3 text-center"><?php echo $boss['xp_reward']; ?></td>
                                <td class="px-2 py-3 text-center"><?php echo $boss['coin_reward']; ?></td>
                                <td class="px-2 py-3 text-center space-x-2">
                                    <a href="index.php?modul=boss_quest&fitur=edit&id=<?php echo $boss['id_boss']; ?>" class="text-blue-600 hover:underline">Edit</a>
                                    <a href="index.php?modul=boss_quest&fitur=delete&id=<?php echo $boss['id_boss']; ?>" onclick="return confirm('Yakin ingin menghapus boss quest ini?')" class="text-red-600 hover:underline">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="mt-4 flex justify-center space-x-2">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?modul=boss_quest&fitur=list&page=<?php echo $i; ?>"
                       class="px-3 py-1 rounded <?php echo $i == $page ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700'; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</body>
</html>
