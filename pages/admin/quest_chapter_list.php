<?php
session_start();
include __DIR__ . '../../db.php';

// Ambil semua chapter dari database (ubah query sesuai kebutuhan jika dari controller)
$query = "SELECT id_chapter, judul_chapter, deskripsi, id_quest FROM quest_chapters ORDER BY id_chapter ASC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Quest Chapter</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <?php include 'includes/navbar.php'; ?>

    <div class="flex">
        <?php include 'includes/sidebar.php'; ?>

        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Daftar Quest Chapter</h2>
                <a href="index.php?modul=quest_chapter&fitur=create" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    + Tambah Chapter
                </a>
            </div>

            <div class="bg-white shadow-md rounded overflow-x-auto">
                <table class="table-fixed text-sm w-full">
                    <thead class="bg-gray-800 text-white uppercase">
                        <tr>
                            <th class="px-2 py-3 w-32 text-left">Judul</th>
                            <th class="px-2 py-3 w-72 text-left">Deskripsi</th>
                            <th class="px-2 py-3 w-20 text-center">ID Quest</th>
                            <th class="px-2 py-3 w-28 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php while ($chapter = mysqli_fetch_assoc($result)) : ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-2 py-3 max-w-[120px] truncate"><?php echo htmlspecialchars($chapter['judul_chapter']); ?></td>
                                <td class="px-2 py-3 max-w-[220px] truncate"><?php echo htmlspecialchars($chapter['deskripsi']); ?></td>
                                <td class="px-2 py-3 text-center"><?php echo $chapter['id_quest']; ?></td>
                                <td class="px-2 py-3 text-center space-x-2">
                                    <a href="index.php?modul=quest_chapter&fitur=edit&id=<?php echo $chapter['id_chapter']; ?>" class="text-blue-600 hover:underline">Edit</a>
                                    <a href="index.php?modul=quest_chapter&fitur=delete&id=<?php echo $chapter['id_chapter']; ?>" onclick="return confirm('Yakin ingin menghapus chapter ini?')" class="text-red-600 hover:underline">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>