<?php
session_start();
include __DIR__ . '../../db.php';

$perPage = 10;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $perPage;

$totalResult = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM quests");
$totalRows = mysqli_fetch_assoc($totalResult)['total'];
$totalPages = ceil($totalRows / $perPage);

$query = "SELECT id_quest, judul, kategori, deskripsi, xp_reward, coin_reward, gambar_icon, mulai_event, akhir_event, tersedia FROM quests ORDER BY id_quest ASC LIMIT $perPage OFFSET $offset";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Quest</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <?php include 'includes/navbar.php'; ?>

    <div class="flex">
        <?php include 'includes/sidebar.php'; ?>

        <div class="flex-1 p-8">
            <div class="container mx-auto">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Quest</h2>
                    <a href="index.php?modul=quest&fitur=create" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        + Tambah Quest
                    </a>
                </div>

                <div class="bg-white shadow-md rounded overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-800 text-white text-sm uppercase">
                            <tr>
                                <th class="px-2 py-3 w-16">Icon</th>
                                <th class="px-2 py-3 w-40 text-left">Judul</th>
                                <th class="px-2 py-3 w-32 text-left">Kategori</th>
                                <th class="px-2 py-3 w-64 text-left">Deskripsi</th>
                                <th class="px-2 py-3 w-16 text-center">XP</th>
                                <th class="px-2 py-3 w-16 text-center">Koin</th>
                                <th class="px-2 py-3 w-40 text-center">Event</th>
                                <th class="px-2 py-3 w-20 text-center">Tersedia</th>
                                <th class="px-2 py-3 w-32 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">
                            <?php while ($quest = mysqli_fetch_assoc($result)) : ?>
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-2 py-3 text-center w-16">
                                        <img src="assets/images/<?php echo htmlspecialchars($quest['gambar_icon']); ?>" alt="icon" class="h-10 mx-auto">
                                    </td>
                                    <td class="px-2 py-3 w-40 max-w-xs truncate"><?php echo htmlspecialchars($quest['judul']); ?></td>
                                    <td class="px-2 py-3 w-32 max-w-xs truncate"><?php echo htmlspecialchars($quest['kategori']); ?></td>
                                    <td class="px-2 py-3 w-64 max-w-xs truncate"><?php echo htmlspecialchars($quest['deskripsi']); ?></td>
                                    <td class="px-2 py-3 text-center w-16"><?php echo $quest['xp_reward']; ?></td>
                                    <td class="px-2 py-3 text-center w-16"><?php echo $quest['coin_reward']; ?></td>
                                    <td class="px-2 py-3 text-center w-40 text-xs text-gray-600">
                                        <?php
                                        if ($quest['mulai_event'] && $quest['akhir_event']) {
                                            echo date('d M Y', strtotime($quest['mulai_event'])) . ' - ' . date('d M Y', strtotime($quest['akhir_event']));
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                    <td class="px-2 py-3 text-center w-20">
                                        <?php echo $quest['tersedia'] == 1 ? 'Ya' : 'Tidak'; ?>
                                    </td>
                                    <td class="px-2 py-3 text-center w-32 space-x-2">
                                        <a href="index.php?modul=quest&fitur=edit&id=<?php echo $quest['id_quest']; ?>" class="text-blue-600 hover:underline">Edit</a>
                                        <a href="index.php?modul=quest&fitur=delete&id=<?php echo $quest['id_quest']; ?>" onclick="return confirm('Yakin ingin menghapus quest ini?')" class="text-red-600 hover:underline">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="mt-4 flex justify-center space-x-2">
                  <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?modul=quest&fitur=list&page=<?php echo $i; ?>"
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
